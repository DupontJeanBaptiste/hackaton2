<?php

namespace App\DataFixtures;

use App\Entity\Tache;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as Faker;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class TacheFixtures extends Fixture implements DependentFixtureInterface
{
    public const TASK_STATUS = [
        'En attente',
        'En cours',
        'En révision',
        'Terminé'
    ];

    public function load(ObjectManager $manager): void
    {
        $faker = Faker::create('fr_FR');
        for ($i = 0; $i < 300; $i++) {
            $tache = new Tache();
            $tache->setName('Tâche_' . $i)
                ->setDescription($faker->paragraph())
                ->setLabel($faker->word())
                ->setStatus(self::TASK_STATUS[array_rand(self::TASK_STATUS)])
                ->setFreeacess(rand(0, 1))
                ->setNumberrequire(rand(0, 5))
                ->addUser($this->getReference('user_' . rand(0, 29)))
                ->setSprint($this->getReference('sprint_' . rand(0, 29)));
                
                $this->addReference('tache_'.$i, $tache);

            $manager->persist($tache);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
