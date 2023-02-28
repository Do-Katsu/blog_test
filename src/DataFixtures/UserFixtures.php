<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    private $encoder;
    public const AUTHOR_USER_REFERENCE = 'author-user';

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        // Admin
        $faker = Faker::create('fr_FR');
        $user = new User();
        $user
            ->setEmail('admin@email.com')
            ->setUsername('KebsiBadr')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->encoder->hashPassword($user, 'admin'))
            ->setIsActive(true)
            ->setCreatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTimeImmutable())
            ;
        $manager->persist($user);
        // Author
        $author = new User();
        $author
            ->setEmail('author@email.com')
            ->setUsername('AdrienFormateur')
            ->setRoles(['ROLE_AUTHOR'])
            ->setPassword($this->encoder->hashPassword($user, 'author'))
            ->setIsActive(true)
            ->setCreatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTimeImmutable())
        ;
        $manager->persist($author);
        // Les autres
        $password = $this->encoder->hashPassword($user, 'password123');
        for ($i=0; $i < 50; $i++) {
            $user = new User();
            $user
                ->setEmail($faker->email())
                ->setUsername($faker->userName())
                ->setPassword($password)
                ->setIsActive(true)
                ->setCreatedAt(new \DateTimeImmutable())
                ->setUpdatedAt(new \DateTimeImmutable())
            ;
            $manager->persist($user);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();

        $this->addReference(self::AUTHOR_USER_REFERENCE, $author);
    }
}
