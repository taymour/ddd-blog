<?php

namespace App\Content\Application\Article\Command\CreateBasicArticle;

use App\Content\Domain\Article\ArticleCreator;
use App\Content\Domain\Model\Article;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class CreateBasicArticleCommandHandler
{
    public function __construct(
        private readonly ArticleCreator $articleCreator,
        private readonly CreateBasicArticleProjection $projection,
        private readonly EventDispatcherInterface $eventDispatcher,
    )
    {
    }

    public function __invoke(CreateBasicArticleCommand $command): void
    {
        $articleEvent = $this->articleCreator->create(new Article(
            null,
            $command->getTitle(),
            $command->getBody(),
        ));

        $this->projection->setArticle($articleEvent->getArticle());

        $this->eventDispatcher->dispatch($articleEvent);
    }
}
