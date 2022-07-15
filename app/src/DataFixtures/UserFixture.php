<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class UserFixture extends Fixture
{
    public const USER_REFERENCE = 'user';
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 5; $i++){
            $manager->persist($this->getUser());
        }
        $this->addReference(self::USER_REFERENCE, $this->getUser());
        $manager->flush();
    }

    private function getUser(): User{
        return new User(
            $this->faker->name(),
            $this->faker->email(),
            $this->faker->password(8)
        );
    }
}
