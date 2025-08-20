<?php

namespace App\Content\Application\Article\Query\GetArticleById;

class GetArticleByIdQuery
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
