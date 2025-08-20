<?php

declare(strict_types=1);

namespace App\Content\Presentation\Http\Dto;

use App\Content\Domain\Model\Article as ArticleModel;

final class ArticleResponseDto
{
    private int $id;
    private string $title;
    private string $content;

    public function __construct(int $id, string $title, string $content)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public static function fromModel(ArticleModel $article): self
    {
        return new self(
            $article->getId(),
            $article->getTitle(),
            $article->getBody()
        );
    }
}
