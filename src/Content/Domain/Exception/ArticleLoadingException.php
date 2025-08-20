<?php

declare(strict_types=1);

namespace App\Content\Domain\Exception;

final class ArticleLoadingException extends \DomainException
{
    public function __construct(int $id, \Throwable $previous = null)
    {
        parent::__construct(sprintf('Article with ID %d not found.', $id), 12254, $previous);
    }
}
