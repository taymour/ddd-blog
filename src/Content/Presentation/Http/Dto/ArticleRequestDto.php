<?php

declare(strict_types=1);

namespace App\Content\Presentation\Http\Dto;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

final class ArticleRequestDto
{
    #[Assert\NotBlank(message: "Le titre est obligatoire.")]
    #[Assert\Length(
        min: 3,
        max: 255,
        minMessage: "Le titre doit faire au moins {{ limit }} caractères.",
        maxMessage: "Le titre ne peut pas dépasser {{ limit }} caractères."
    )]
    private string $title;

    #[Assert\NotBlank(message: "Le contenu est obligatoire.")]
    #[Assert\Length(
        min: 10,
        minMessage: "Le contenu doit faire au moins {{ limit }} caractères."
    )]
    private string $content;

    public function __construct(string $title, string $content)
    {
        $this->title = $title;
        $this->content = $content;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            (string) $request->get('title'),
            (string) $request->get('content'),
        );
    }
}
