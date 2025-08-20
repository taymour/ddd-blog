<?php

declare(strict_types=1);

namespace App\Content\Domain\Article;

use App\Content\Domain\Exception\ArticleLoadingException;
use App\Content\Domain\Model\Article;
use App\Content\Domain\Storage\ArticleStorageInterface;

final class ArticleLoader
{
    public function __construct(private readonly ArticleStorageInterface $storage)
    {
    }

    public function load(string $id): Article
    {
        try {
            return $this->storage->findOneById($id);
        } catch (\Throwable $exception) {
            throw new ArticleLoadingException($id, $exception);
        }
    }
}
