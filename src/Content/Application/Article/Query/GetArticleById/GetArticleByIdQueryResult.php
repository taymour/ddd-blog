<?php

declare(strict_types=1);

namespace App\Content\Application\Article\Query\GetArticleById;

use App\Content\Domain\Model\Article as ArticleModel;

final class GetArticleByIdQueryResult
{
    public function __construct(private readonly ArticleModel $article)
    {
    }

    public function getArticle(): ArticleModel
    {
        return $this->article;
    }
}
