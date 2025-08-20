<?php

declare(strict_types=1);

namespace App\Content\Domain\Exception;

final class ArticleCreationException extends \DomainException
{
    public function __construct(\Throwable $previous = null)
    {
        parent::__construct('Failed to create article.', 12255, $previous);
    }
}
