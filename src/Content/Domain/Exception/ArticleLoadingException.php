<?php

declare(strict_types=1);

namespace App\Content\Domain\Exception;

final class ArticleLoadingException extends \DomainException
{
    public function __construct(string $id, \Throwable $previous = null)
    {
        parent::__construct(sprintf('Article with ID %s not found.', $id), 12254, $previous);
    }
}
