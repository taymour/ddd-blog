<?php

declare(strict_types=1);

namespace App\Content\Presentation\Http\Controller;

use App\Content\Application\Article\Command\CreateBasicArticle\CreateBasicArticleCommand;
use App\Content\Application\Article\Query\GetArticleById\GetArticleByIdQuery;
use App\Content\Infrastructure\Doctrine\Id\Uuid;
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
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;


final class ArticleController extends AbstractController
{
    #[Route('/article/get/{id}', name: 'article_show', methods: ['GET'])]
    public function getArticle(
        string $id,
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
                sprintf('Article with ID %s not found.', $id),
                $e,
            );
        }
    }

    #[Route('/article/create', name: 'article_create', methods: ['GET'])]
    public function createArticle(
        MessageBusInterface $bus,
        Request $request,
        ValidatorInterface $validator,
        RouterInterface $router,
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

        $id = Uuid::createNew();

        try {
            $bus->dispatch(new CreateBasicArticleCommand(
                $id->getUuid(),
                $articleDto->getTitle(),
                $articleDto->getContent()
            ));

            return $this->json(
                $router->generate('article_show', ['id' => $id->getUuid()], RouterInterface::ABSOLUTE_URL),
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
