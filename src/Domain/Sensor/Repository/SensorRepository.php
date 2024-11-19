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
     * Returns an array of Sensor objects in order ASC
     * @return Sensor[]|null
     */
    public function getAllInAscOrder():? array
    {
        $rows = $this->createQueryBuilder('s')
            ->orderBy('s.name', 'ASC')
            ->getQuery()
            ->getResult();

        return is_array($rows) && !empty($rows)
            ? $rows
            : null;
    }
}
