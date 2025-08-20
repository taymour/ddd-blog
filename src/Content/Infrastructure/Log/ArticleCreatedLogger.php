<?php

declare(strict_types=1);

namespace App\Content\Infrastructure\Log;

use App\Content\Domain\Event\ArticleCreatedEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener]
final class ArticleCreatedLogger
{
    public function __construct(private readonly LoggerInterface $logger)
    {
    }

    public function __invoke(ArticleCreatedEvent $event): void
    {
        $this->logger->info(sprintf(
            'Article created: "%s" (ID: %s)',
            $event->getArticle()->getTitle(),
            $event->getArticle()->getId()
        ));
    }
}
