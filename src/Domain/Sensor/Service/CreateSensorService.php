<?php

namespace App\Domain\Sensor\Service;

use App\Domain\Sensor\Entity\Sensor;
use App\Domain\Sensor\Exception\CreateSensorException;
use App\Util\Interfaces\CreateServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

final class CreateSensorService implements CreateServiceInterface
{

    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function create(Request $request):? Sensor
    {
        try {
            $sensor = new Sensor;
            $sensor->setName((string) $request->request->get('name'));

            $this->entityManager->persist($sensor);
            $this->entityManager->flush();
        } catch (CreateSensorException $e) {
            error(getExceptionStr($e));
        }

        return $sensor;
    }
}
