<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public const TEAMS = [
        'Strasbourg',
        'Paris',
        'Lille',
        'Marseille',
        'Londre',
        'Los Angeles'
    ];

    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Faker::create('fr_FR');
        $plaintextPassword = 'password';

        for ($i = 0; $i < 30; $i++) {
            $user = new User();
            $user->setEmail($faker->userName() . '@apside.com')
                ->setPassword($this->passwordHasher->hashPassword($user, $plaintextPassword))
                ->setFirstname($faker->firstName())
                ->setLastname($faker->lastName())
                ->setRoles(['ROLE_USER'])
                ->setTeam(self::TEAMS[array_rand(self::TEAMS)])
                ->setPost('Web Developper');
            
            for ($j = 0; $j < rand(1, 5); $j++) {
                $user->addProject($this->getReference('project_' . rand(0, 9)));
            }

            $this->addReference('user_' . $i, $user);

            $manager->persist($user);
        }

        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->setEmail($faker->userName() . '@apside.com')
                ->setPassword($this->passwordHasher->hashPassword($user, $plaintextPassword))
                ->setFirstname($faker->firstName())
                ->setLastname($faker->lastName())
                ->setRoles(['ROLE_ADMIN'])
                ->setTeam(self::TEAMS[array_rand(self::TEAMS)])
                ->setPost('Web Developper/PO');

            for ($j = 0; $j < rand(1, 5); $j++) {
                $user->addProject($this->getReference('project_' . rand(0, 9)));
            }

            $manager->persist($user);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProjectFixtures::class,
        ];
    }
}
