<?php

declare(strict_types=1);

namespace App\Domain\Sensor\Exception;

use Exception;

final class CreateSensorException extends Exception
{

    public function __construct(
        string $message = 'Error creating the sensor',
        int $code = 0
    )
    {
        parent::__construct($message, $code);
    }

    public function __toString()
    {
        return $this->getMessage();
    }
}
