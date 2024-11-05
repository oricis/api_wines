<?php

namespace App\Domain\Sensor\Controller\Api\V1;

use App\Domain\Sensor\Event\SensorEvent;
use App\Domain\Sensor\Repository\SensorRepository;
use App\Domain\Sensor\Service\SensorResponseService;
use App\Util\Misc\HttpStatusCode;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ListSensorController extends AbstractController
{

    #[Route('/api/v1/sensor', name: 'api_sensors', methods: ['GET'])]
    public function __invoke(SensorRepository $sensorRepository): JsonResponse
    {
        $sensors = $sensorRepository->getAllInAscOrder();

        $preparedSensors = [];
        foreach ($sensors as $sensor) {
            $preparedSensors[] = SensorResponseService::get($sensor);
        }

        $statusCode = HttpStatusCode::OK;
        $message = SensorEvent::READ_ROWS;
        if (empty($preparedSensors)) {
            $statusCode = HttpStatusCode::NOT_FOUND;
            $message = 'Error trying create the register';
        }

        $output = [
            'message' => $message,
            'data' => [
                'sensors' => $preparedSensors,
                'total' => count($preparedSensors),
            ],
        ];

        return new JsonResponse($output, $statusCode);
    }
}
