<?php

namespace App\Domain\User\Service;

use App\Domain\User\Entity\User;
use App\Util\Exceptions\RequireSpecificObjectException;
use App\Util\Interfaces\ResponseServiceInterface;

final class AuthenticateUserResponseService implements ResponseServiceInterface
{

    /*
     * TODO: test
     *
     * @return array<string,mixed>
     */
    public static function get(object $user): array
    {
        try {
            if (!$user instanceof User) {
                $message = 'Error arg: not User object';
                throw new RequireSpecificObjectException($message);
            }
        } catch (\Exception $e) {
            error(getExceptionStr($e));
            return [];
        }

        return [
            'email'   => $user->getEmail(),
            'id'      => $user->getId(),
            'name'    => $user->getName(),
            'surname' => $user->getSurname(),
            'token'   => $user->getApiToken(),
        ];
    }
}
