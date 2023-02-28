<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Repository\ArticleRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as Faker;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    protected $userRepository;
    protected $articleRepository;

    public function __construct(UserRepository $userRepository, ArticleRepository $articleRepository)
    {
        $this->userRepository = $userRepository;
        $this->articleRepository = $articleRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Faker::create('fr_FR');

        $users = $this->userRepository->findAll();
        $usersLength = count($users)-1;

        $articles = $this->articleRepository->findAll();
        $articlesLength = count($users)-1;

        for ($i=0; $i < 300; $i++) {
            $randomKeyUsers = rand(0, $usersLength);
            $user = $users[$randomKeyUsers];

            $randomKeyArticless = rand(0, $articlesLength);
            $article = $articles[$randomKeyArticless];

            $comment = new Comment();
            $comment
                ->setContent($faker->sentence())
                ->setAuthor($user)
                ->setArticle($article)
                ->setCreatedAt(new \DateTimeImmutable())
                ->setIsActive(true)
            ;
            $manager->persist($comment);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            ArticleFixtures::class,
        );
    }
}
