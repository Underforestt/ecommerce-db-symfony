<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class ProductFixture extends Fixture implements DependentFixtureInterface
{
    public const PRODUCT_REFERENCE = 'product';
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 15; $i++){
            $manager->persist($this->getProduct());
        }
        $this->addReference(self::PRODUCT_REFERENCE, $this->getProduct());
        $manager->flush();
    }

    private function getProduct(): Product
    {
        return new Product(
            $this->getReference(CategoryFixture::CATEGORY_REFERENCE),
            $this->faker->text(15),
            $this->faker->paragraph(3),
            $this->faker->randomFloat(2),
            $this->faker->numberBetween(10, 50)
        );
    }

    public function getDependencies()
    {
        return [
            CategoryFixture::class
        ];
    }
}
