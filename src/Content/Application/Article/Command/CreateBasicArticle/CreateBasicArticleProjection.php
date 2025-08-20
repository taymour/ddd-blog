<?php

declare(strict_types=1);

namespace App\Content\Application\Article\Command\CreateBasicArticle;

use App\Content\Domain\Model\Article;

final class CreateBasicArticleProjection
{
    private ?Article $article;

    public function setArticle(Article $article): void
    {
        $this->article = $article;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }
}
