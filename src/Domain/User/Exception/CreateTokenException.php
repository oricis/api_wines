<?php

declare(strict_types=1);

namespace App\Domain\User\Exception;

use Exception;

final class CreateTokenException extends Exception
{

    public function __construct(
        string $message = 'Error creating a token',
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
