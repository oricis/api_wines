<?php

namespace App\Tests\Functional\App\Domain\Measurement;

use App\Domain\Sensor\Service\QuerySensorService;
use App\Domain\Wine\Service\QueryWineService;

trait CreateMeasurementTrait
{

    public function getData(): array
    {
        $dbName = $_ENV['TEST_DB_NAME'];
        $querySensorService = new QuerySensorService($dbName);
        $queryWineService = new QueryWineService($dbName);

        $sensorId = $querySensorService->getRandomId();
        $wineId = $queryWineService->getRandomId();
        if ($sensorId === 0 || $wineId === 0) {
            dd('ERR => wines and/or sensors tables are empty!', $sensorId, $wineId);
        }

        return [
            'alcohol_content' => rand(1, 12),
            'color'       => 'red',
            'ph'          => rand(5, 8),
            'sensor_id'   => $sensorId,
            'temperature' => rand(5, 21),
            'wine_id'     => $wineId,
            'year'        => rand(1900, date('Y')),
        ];
    }
}
