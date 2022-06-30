<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as Faker;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker::create('fr_FR');

        for ($i = 0; $i < 150; $i++) {
            $comment = new Comment();
            $comment->setUser(($this->getReference('user_' . rand(0, 29))))
                ->setTache($this->getReference('tache_' . rand(0, 299)))
                ->setContent($faker->paragraph());
            $manager->persist($comment);
        }


        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            TacheFixtures::class
        ];
    }
}
