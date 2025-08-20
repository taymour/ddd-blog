<?php

declare(strict_types=1);

namespace App\Content\Infrastructure\Doctrine\Repository;

use App\Content\Domain\Storage\ArticleStorageInterface;
use App\Content\Infrastructure\Doctrine\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Content\Domain\Model\Article as ArticleModel;
use Doctrine\Persistence\ManagerRegistry;

final class ArticleRepository extends ServiceEntityRepository implements ArticleStorageInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function findOneById(int $id): ArticleModel
    {
        $article = $this->findOneBy(['id' => $id]);

        if (null === $article) {
            throw new \LogicException(sprintf('Article with id "%s" does not exist in database.', $id));
        }

        return $article->toModel();
    }

    public function articleWithTitleExists(string $title): bool
    {
        return null !== $this->findOneBy(['title' => $title]);
    }

    public function save(ArticleModel $article): ArticleModel
    {
        $entity = Article::fromModel($article);

        $em = $this->getEntityManager();
        $em->persist($entity);
        $em->flush();

        return $entity->toModel();
    }
}
