<?php

declare(strict_types=1);

namespace App\Domain\Measurement\Exception;

use Exception;

final class CreateMeasurementException extends Exception
{

    public function __construct(
        string $message = 'Error creating the measurement',
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
