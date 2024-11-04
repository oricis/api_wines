<?php

namespace App\Domain\Sensor\Service;

use App\Domain\Sensor\Entity\Sensor;
use App\Util\Exceptions\RequireSpecificObjectException;
use App\Util\Interfaces\ResponseServiceInterface;

final class SensorResponseService implements ResponseServiceInterface
{
    public static function get(object $sensor): array
    {
        try {
            if (!$sensor instanceof Sensor) {
                $message = 'Error arg: not Sensor object';
                throw new RequireSpecificObjectException($message);
            }
        } catch (\Exception $e) {
            error(getExceptionStr($e));
            return [];
        }

        return [
            'id'   => $sensor->getId(),
            'name' => $sensor->getName(),
        ];
    }
}
