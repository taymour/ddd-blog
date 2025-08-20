<?php

namespace App\DataFixtures;

use App\Content\Infrastructure\Doctrine\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $article = new Article();
        $article->setTitle('Sample Article Title');
        $article->setBody('This is a sample body for the article.');
        $manager->persist($article);



        $article = new Article();
        $article->setTitle('Sample Article Title 2');
        $article->setBody('This is a sample body for the article 2.');
        $manager->persist($article);


        $article = new Article();
        $article->setTitle('Sample Article Title 3');
        $article->setBody('This is a sample body for the article 3.');
        $manager->persist($article);


        $manager->flush();
    }
}
