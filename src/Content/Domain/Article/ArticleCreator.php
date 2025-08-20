<?php

declare(strict_types=1);

namespace App\Content\Domain\Article;

use App\Content\Domain\Exception\ArticleAlreadyExistsException;
use App\Content\Domain\Exception\ArticleCreationException;
use App\Content\Domain\Model\Article;
use App\Content\Domain\Storage\ArticleStorageInterface;

final class ArticleCreator
{
    public function __construct(private readonly ArticleStorageInterface $storage)
    {
    }

    public function create(Article $article): Article
    {
        if ($this->storage->articleWithTitleExists($article->getTitle())) {
            throw new ArticleAlreadyExistsException($article);
        }

        try {
            return $this->storage->save($article);
        } catch (\Throwable $exception) {
            throw new ArticleCreationException($exception);
        }
    }
}
