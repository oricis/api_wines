<?php

namespace App\Domain\Wine\Repository;

use App\Domain\Wine\Entity\Wine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Wine>
 */
class WineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Wine::class);
    }

    /**
     * Returns an array of Wine objects with their measurements
     *
     * @return Wine[]|null
     */
    public function getWinesWithMeasurements():? array
    {
        $rows = $this->createQueryBuilder('w')
            ->select('w, m')
            ->join('w.measurements', 'm')
            ->getQuery()
            ->getResult();

        return is_array($rows) && !empty($rows)
            ? $rows
            : null;
    }
}
