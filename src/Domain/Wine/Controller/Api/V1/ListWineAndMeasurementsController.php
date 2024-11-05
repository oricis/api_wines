<?php

namespace App\Domain\Wine\Controller\Api\V1;

use App\Domain\Wine\Event\WineEvent;
use App\Domain\Wine\Repository\WineRepository;
use App\Domain\Wine\Service\WineWithMeasurementsResponseService;
use App\Util\Misc\HttpStatusCode;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ListWineAndMeasurementsController extends AbstractController
{

    #[Route('/api/v1/wine/measurement', name: 'api_wines', methods: ['GET'])]
    public function __invoke(WineRepository $wineRepository): JsonResponse
    {
        $wines = $wineRepository->getWinesWithMeasurements();

        $preparedWines = [];
        foreach ($wines as $wine) {
            $preparedWines[] = WineWithMeasurementsResponseService::get($wine);
        }

        $statusCode = HttpStatusCode::OK;
        $message = WineEvent::READ_ROWS;
        if (empty($preparedWines)) {
            $statusCode = HttpStatusCode::NOT_FOUND;
            $message = 'Error trying create the register';
        }

        $output = [
            'message' => $message,
            'data' => [
                'wines' => $preparedWines,
                'total' => count($preparedWines),
            ],
        ];

        return new JsonResponse($output, $statusCode);
    }
}
