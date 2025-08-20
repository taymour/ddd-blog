<?php

declare(strict_types=1);

namespace App\Content\Presentation\Http\Controller;

use App\Content\Application\Article\Query\GetArticleById\GetArticleByIdQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Attribute\Route;

final class ArticleController extends AbstractController
{
    #[Route('/article/{id}', name: 'article_show', methods: ['GET'])]
    public function getArticle(int $id, MessageBusInterface $bus): JsonResponse
    {
        $article = $bus->dispatch(new GetArticleByIdQuery($id))->last(HandledStamp::class)->getResult();

        dd($article);
        return new JsonResponse("Displaying article with ID: $id");
    }
}
