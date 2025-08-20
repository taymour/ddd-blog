<?php

declare(strict_types=1);

namespace App\Content\Domain\Event;

use App\Content\Domain\Model\Article;

final class ArticleCreatedEvent
{
    private const MESSAGE = 'An article was created.';

    public function __construct(private readonly Article $article)
    {
    }

    public function getArticle(): Article
    {
        return $this->article;
    }

    public function getMessage(): string
    {
        return self::MESSAGE;
    }
}
