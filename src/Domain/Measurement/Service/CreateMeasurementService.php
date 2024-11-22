<?php

namespace App\Domain\Measurement\Service;

use App\Domain\Measurement\Entity\Measurement;
use App\Domain\Measurement\Exception\CreateMeasurementException;
use App\Util\Interfaces\CreateServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

final class CreateMeasurementService implements CreateServiceInterface
{

    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function create(Request $request):? Measurement
    {
        try {
            $measurement = new Measurement;
            $measurement->setYear((int) $request->request->get('year'));
            $measurement->setColor((string) $request->request->get('color'));
            $measurement->setTemperature((int) $request->request->get('temperature'));
            $measurement->setPh((float) $request->request->get('ph'));
            $measurement->setAlcoholContent((int) $request->request->get('alcohol_content'));
            $measurement->setSensorId((int) $request->request->get('sensor_id'));
            $measurement->setWineId((int) $request->request->get('wine_id'));
            $this->entityManager->persist($measurement);
            $this->entityManager->flush();
        } catch (CreateMeasurementException $e) {
            error(getExceptionStr($e));
        }

        return $measurement;
    }
}
