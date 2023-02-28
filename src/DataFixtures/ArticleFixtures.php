<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\User;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory as Faker;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    protected $userRepository;
    protected $categoryRepository;

    public function __construct(UserRepository $userRepository, CategoryRepository $categoryRepository)
    {
        $this->userRepository = $userRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Faker::create('fr_FR');
//        $user = $manager->getRepository(User::class)->findOneBy(['roles' => 'ROLE_AUTHOR']);
        $users = $this->userRepository->findAll();
        $usersLength = count($users)-1;

        $categories = $this->categoryRepository->findAll();
        $CategoriesLength = count($categories)-1;


        for ($i=0; $i < 100; $i++) {
            $randomKeyUsers = rand(0, $usersLength);
            $user = $users[$randomKeyUsers];

            $randomKeyCategories = rand(0, $CategoriesLength);
            $category = $categories[$randomKeyCategories];

            $article = new Article();
            $article
                ->setTitle($faker->words(2, true))
                ->setContent($faker->text(200))
                ->setFeaturedText($faker->text(100))
                ->setStatus($faker->randomElement([0, 1]))
                ->setFeaturedImage($faker->word())
                ->setCreatedAt(new \DateTimeImmutable())
                ->setUpdatedAt(new \DateTimeImmutable())
                ->setAuthor($this->getReference(UserFixtures::AUTHOR_USER_REFERENCE))
                ->addCategory($category)
            ;
            $manager->persist($article);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}
