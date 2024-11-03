<?php

namespace App\Domain\Sensor\Repository;

use App\Domain\Sensor\Entity\Sensor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sensor>
 */
class SensorRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sensor::class);
    }

    /**
    * @return Sensor[] Returns an array of Sensor objects in order ASC
    */
    public function getAllInAscOrder(): array
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.name', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
}
