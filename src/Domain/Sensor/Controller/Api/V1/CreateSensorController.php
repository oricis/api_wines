<?php

namespace App\Domain\Sensor\Controller\Api\V1;

use App\Domain\Sensor\Event\SensorEvent;
use App\Domain\Sensor\Service\CreateSensorService;
use App\Domain\Sensor\Service\SensorResponseService;
use App\Util\Misc\HttpStatusCode;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateSensorController extends AbstractController
{

    #[Route('/api/v1/sensor', name: 'api_create_sensor', methods: ['POST'])]
    public function __invoke(
        CreateSensorService $createSensorService,
        Request $request
    ): JsonResponse
    {
        $sensor = $createSensorService->create($request);

        $statusCode = HttpStatusCode::CREATED;
        $message = SensorEvent::CREATE;
        if (is_null($sensor)) {
            $statusCode = HttpStatusCode::TEAPOT;
            $message = 'Error trying create the register';
        } else {
            $data = SensorResponseService::get($sensor);
        }

        $output = [
            'message' => $message,
            'data' => $data ?? null,
        ];

        return new JsonResponse($output, $statusCode);
    }
}
