<?php

declare(strict_types=1);

namespace App\Util\Interfaces;

interface ResponseServiceInterface
{
    public static function get(object $object): array;
}
