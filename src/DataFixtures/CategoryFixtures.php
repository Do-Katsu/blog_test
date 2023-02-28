<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as Faker;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker::create('fr_FR');
        for ($i=0; $i < 10; $i++) {
            $category = new Category();
            $category
                ->setName($faker->word())
                ->setColor($faker->hexColor())
                ->setCreatedAt(new \DateTimeImmutable())
                ->setUpdatedAt(new \DateTimeImmutable())
            ;
            $manager->persist($category);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
