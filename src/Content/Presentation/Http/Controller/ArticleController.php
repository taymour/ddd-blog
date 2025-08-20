<?php

declare(strict_types=1);

namespace App\Content\Presentation\Http\Controller;

use App\Content\Application\Article\Command\CreateBasicArticle\CreateBasicArticleCommand;
use App\Content\Application\Article\Command\CreateBasicArticle\CreateBasicArticleProjection;
use App\Content\Application\Article\Query\GetArticleById\GetArticleByIdQuery;
use App\Content\Presentation\Http\Dto\ArticleRequestDto;
use App\Content\Presentation\Http\Dto\ArticleResponseDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;


final class ArticleController extends AbstractController
{
    #[Route('/article/get/{id}', name: 'article_show', methods: ['GET'])]
    public function getArticle(
        int $id,
        MessageBusInterface $bus,
    ): JsonResponse
    {
        try {
            $result = $bus->dispatch(new GetArticleByIdQuery($id))->last(HandledStamp::class)->getResult();

            return $this->json(
                ArticleResponseDto::fromModel($result->getArticle())
            );
        } catch (\Throwable $e) {
            throw new NotFoundHttpException(
                sprintf('Article with ID %d not found.', $id),
                $e,
            );
        }
    }

    #[Route('/article/create', name: 'article_create', methods: ['GET'])]
    public function createArticle(
        MessageBusInterface $bus,
        Request $request,
        ValidatorInterface $validator,
        CreateBasicArticleProjection $projection,
    ): JsonResponse {
        $articleDto = ArticleRequestDto::fromRequest($request);

        $errors = $validator->validate($articleDto);

        if (count($errors) > 0) {
            $messages = [];
            foreach ($errors as $error) {
                $messages[$error->getPropertyPath()][] = $error->getMessage();
            }

            return $this->json(
                ['errors' => $messages],
                JsonResponse::HTTP_BAD_REQUEST
            );
        }

        try {
            $bus->dispatch(new CreateBasicArticleCommand(
                $articleDto->getTitle(),
                $articleDto->getContent()
            ));

            // can wait here if the command is async

            return $this->json(
                $projection->getArticle(),
                JsonResponse::HTTP_CREATED
            );
        } catch (\Throwable $e) {
            throw new BadRequestHttpException(
                'Article creation error.',
                $e,
            );
        }
    }
}
