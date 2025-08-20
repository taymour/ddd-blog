<?php

namespace App\Content\Application\Article\Query\GetArticleById;

use App\Content\Domain\Article\ArticleLoader;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class GetArticleByIdQueryHandler
{
    public function __construct(private readonly ArticleLoader $articleLoader)
    {
    }

    public function __invoke(GetArticleByIdQuery $query): GetArticleByIdQueryResult
    {
        $article = $this->articleLoader->load($query->getId());

        return new GetArticleByIdQueryResult(
            $article->getId(),
            $article->getTitle(),
            $article->getBody()
        );
    }
}
