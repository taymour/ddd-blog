<?php

declare(strict_types=1);

namespace App\Content\Domain\Model;

class Article
{
    private ?string $id;

    private string $title;

    private string $body;

    public function __construct(?string $id, string $title, string $body)
    {
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getBody(): string
    {
        return $this->body;
    }
}
