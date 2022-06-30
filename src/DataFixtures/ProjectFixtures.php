<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as Faker;
use App\Entity\Project;

class ProjectFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $project = new Project();
            $project->setName($faker->sentence(2))
            ->setDescription($faker->paragraph())
            ->setClient($faker->company())
            ->setStatus(rand(0, 1))
            ->setPo($faker->name())
            ->setCreationDate($faker->dateTimeThisYear())
            ->setEnddate($faker->dateTimeInInterval('now', '+6 months'));

            $this->addReference('project_'.$i, $project);
        
        $manager->persist($project);

        }
        $manager->flush();
    }
}
