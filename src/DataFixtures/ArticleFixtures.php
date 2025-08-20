<?php

namespace App\DataFixtures;

use App\Content\Infrastructure\Doctrine\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $article = new Article();
        $article->setId(Uuid::v4()->toString());
        $article->setTitle('Sample Article Title');
        $article->setBody('This is a sample body for the article.');
        $manager->persist($article);



        $article = new Article();
        $article->setId(Uuid::v4()->toString());
        $article->setTitle('Sample Article Title 2');
        $article->setBody('This is a sample body for the article 2.');
        $manager->persist($article);


        $article = new Article();
        $article->setId(Uuid::v4()->toString());
        $article->setTitle('Sample Article Title 3');
        $article->setBody('This is a sample body for the article 3.');
        $manager->persist($article);


        $manager->flush();
    }
}
