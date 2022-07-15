<?php

namespace App\DataFixtures;

use App\Entity\OrderProduct;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class OrderProductFixture extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager): void
    {
        $manager->persist($this->getOrderProduct());
        $manager->flush();
    }

    public function getOrderProduct(): OrderProduct{
        return new OrderProduct(
            $this->getReference(OrderFixture::ORDER_REFERENCE),
            $this->getReference(ProductFixture::PRODUCT_REFERENCE),
            $this->faker->numberBetween(1, 10)
        );
    }

    public function getDependencies()
    {
        return [
            OrderFixture::class,
            ProductFixture::class
        ];
    }
}
