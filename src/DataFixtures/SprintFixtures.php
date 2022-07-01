<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as Faker;
use App\Entity\Sprint;


class SprintFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker::create('fr_FR');


        for ($i = 0; $i < 30; $i++) {
            $sprint = new Sprint();
            $sprint->setNumber(1)
                ->setDescription($faker->paragraph())
                ->setCreationdate($faker->dateTimeInInterval('-1 week', '+1 week'))
                ->setEnddate($faker->dateTimeInInterval('now', '+6 months'))
                ->setProject($this->getReference('project_' . rand(0, 9)));
            
                $this->addReference('sprint_'. $i, $sprint);

            $manager->persist($sprint);
        }



        $manager->flush();
    }
}
