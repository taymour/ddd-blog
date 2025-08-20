<?php

declare(strict_types=1);

namespace App\Content\Infrastructure\Doctrine\Entity;

use App\Content\Domain\Model\Article as ArticleModel;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'articles')]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $title;

    #[ORM\Column(type: 'text')]
    private string $body;

    public function getId(): ?int
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

    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function toModel(): ArticleModel
    {
        return new ArticleModel(
            $this->id,
            $this->title,
            $this->body
        );
    }

    public static function fromModel(ArticleModel $articleModel): self
    {
        $article = new self();
        $article->id = $articleModel->getId() ?? null;
        $article->title = $articleModel->getTitle();
        $article->body = $articleModel->getBody();

        return $article;
    }
}
