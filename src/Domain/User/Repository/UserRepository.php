<?php

namespace App\Domain\User\Repository;

use App\Domain\User\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function getUserFromApiToken(string $apiToken):? User
    {
        return $this->findOneBy(['api_token' => $apiToken]);
    }

    public function getUserFromEmail(string $email):? User
    {
        return $this->findOneBy(['email' => $email]);
    }
}
