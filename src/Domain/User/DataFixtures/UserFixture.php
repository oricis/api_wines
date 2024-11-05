<?php

namespace App\Domain\User\DataFixtures;

use App\Domain\User\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends Fixture
{

    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager)
    {
        $password = 12345678;

        // create 10 users! Bam!
        for ($i = 0; $i < 10; $i++) {
            $name = 'user ' . $i;


            $user = new User();
            $user->setName(ucfirst($name));
            $user->setSurname(ucfirst($name . $name));
            $user->setEmail($name . '@mail.com');

            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                $password
            );
            $user->setPassword($hashedPassword);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
