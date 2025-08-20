<?php

declare(strict_types=1);

namespace App\Content\Domain\Article;

use App\Content\Domain\Model\Article;
use App\Content\Domain\Storage\ArticleStorageInterface;

final class ArticleLoader
{
    public function __construct(private readonly ArticleStorageInterface $storage)
    {
    }

    public function load(int $id): Article
    {
        return $this->storage->findOneById($id);
    }
}
