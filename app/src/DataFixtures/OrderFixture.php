<?php

namespace App\DataFixtures;

use App\Entity\Order;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class OrderFixture extends Fixture implements DependentFixtureInterface
{
    public const ORDER_REFERENCE = 'order';
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 10; $i++){
            $manager->persist($this->getOrder());
        }
        $this->addReference(self::ORDER_REFERENCE, $this->getOrder());
        $manager->flush();
    }

    private function getOrder(): Order{
        return new Order(
            $this->getReference(UserFixture::USER_REFERENCE),
            \DateTimeImmutable::createFromMutable($this->faker->dateTime()),
            \DateTimeImmutable::createFromMutable($this->faker->dateTime())
        );
    }

    public function getDependencies()
    {
        return [
            UserFixture::class
        ];
    }
}
