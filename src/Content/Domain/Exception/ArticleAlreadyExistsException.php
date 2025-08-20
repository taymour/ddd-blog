<?php

declare(strict_types=1);

namespace App\Content\Domain\Exception;

use App\Content\Domain\Model\Article;

final class ArticleAlreadyExistsException extends \DomainException
{
    public function __construct(Article $article, \Throwable $previous = null)
    {
        parent::__construct(
            sprintf('Article with title "%s" already exists.', $article->getTitle()),
            12257,
            $previous
        );
    }
}
