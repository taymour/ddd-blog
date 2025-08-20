<?php

namespace App\Content\Application\Article\Command\CreateBasicArticle;

use App\Content\Domain\Article\ArticleCreator;
use App\Content\Domain\Model\Article;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class CreateBasicArticleCommandHandler
{
    public function __construct(
        private readonly ArticleCreator $articleCreator,
        private readonly CreateBasicArticleProjection $projection,
    )
    {
    }

    public function __invoke(CreateBasicArticleCommand $command): void
    {
        $article = $this->articleCreator->create(new Article(
            null,
            $command->getTitle(),
            $command->getBody(),
        ));

        $this->projection->setArticle($article);
    }
}
