<?php

declare(strict_types=1);

namespace App\Content\Domain\Storage;

use App\Content\Domain\Model\Article;

interface ArticleStorageInterface
{
    public function findOneById(int $id): Article;
}
