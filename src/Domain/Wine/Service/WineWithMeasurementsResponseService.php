<?php

namespace App\Domain\Wine\Service;

use App\Domain\Measurement\Service\MeasurementResponseService;
use App\Domain\Wine\Entity\Wine;
use App\Util\Exceptions\RequireSpecificObjectException;
use App\Util\Interfaces\ResponseServiceInterface;

final class WineWithMeasurementsResponseService implements ResponseServiceInterface
{

    /*
     * TODO: test
     *
     * @return array<string,mixed>
     */
    public static function get(object $wine): array
    {
        try {
            if (!$wine instanceof Wine) {
                $message = 'Error arg: not Wine object';
                throw new RequireSpecificObjectException($message);
            }
        } catch (\Exception $e) {
            error(getExceptionStr($e));
            return [];
        }

        $preparedMeasurements = [];
        foreach ($wine->getMeasurements() as $measurement) {
            $preparedMeasurements[]
                = MeasurementResponseService::get($measurement);
        }

        return [
            'id'   => $wine->getId(),
            'name' => $wine->getName(),
            'year' => $wine->getYear(),
            'measurements' => $preparedMeasurements,
        ];
    }
}
