<?php

namespace App\Domain\Measurement\Service;

use App\Domain\Measurement\Entity\Measurement;
use App\Util\Exceptions\RequireSpecificObjectException;
use App\Util\Interfaces\ResponseServiceInterface;

final class MeasurementResponseService implements ResponseServiceInterface
{

    /*
     * @return array<string,mixed>|[]
     */
    public static function get(object $measurement): array
    {
        try {
            if (!$measurement instanceof Measurement) {
                $message = 'Error arg: not Measurement object';
                throw new RequireSpecificObjectException($message);
            }
        } catch (\Exception $e) {
            error(getExceptionStr($e));
            return [];
        }

        return [
            'alcohol_content' => $measurement->getAlcoholContent(),
            'color'       => $measurement->getColor(),
            'id'          => $measurement->getId(),
            'ph'          => $measurement->getPh(),
            'sensor_id'   => $measurement->getSensorId(),
            'temperature' => $measurement->getTemperature(),
            'wine_id'     => $measurement->getWineId(),
            'year'        => $measurement->getYear(),
        ];
    }
}
