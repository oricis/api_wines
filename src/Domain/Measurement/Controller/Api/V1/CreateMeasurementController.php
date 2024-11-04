<?php

namespace App\Domain\Measurement\Controller\Api\V1;

use App\Domain\Measurement\Event\MeasurementEvent;
use App\Domain\Measurement\Service\CreateMeasurementService;
use App\Domain\Measurement\Service\MeasurementResponseService;
use App\Util\Misc\HttpStatusCode;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateMeasurementController extends AbstractController
{

    #[Route('/api/v1/measurement', name: 'api_create_measurement', methods: ['POST'])]
    public function __invoke(
        CreateMeasurementService $createMeasurementService,
        Request $request
    ): JsonResponse
    {
        $sensor = $createMeasurementService->create($request);

        $statusCode = HttpStatusCode::CREATED;
        $message = MeasurementEvent::CREATE;
        if (is_null($sensor)) {
            $statusCode = HttpStatusCode::TEAPOT;
            $message = 'Error trying create the register';
        }

        $output = [
            'message' => $message,
            'data' => MeasurementResponseService::get($sensor),
        ];

        return new JsonResponse($output, $statusCode);
    }
}
