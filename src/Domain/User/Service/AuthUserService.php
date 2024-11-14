<?php

declare(strict_types=1);

namespace App\Domain\User\Service;

use App\Domain\User\Entity\User;
use App\Domain\User\Exception\CreateTokenException;
use App\Util\Misc\ApiUtils;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AuthUserService
{
    public const MIN_PASSWORD_LENGTH = 8;


    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
        private EntityManagerInterface $entityManager
    )
    {
    }

    public function login(Request $request):? User
    {
        $email = (string) $request->request->get('user');
        $password = (string) $request->request->get('password');
        $user = $this->entityManager
            ->getRepository(User::class)
            ->findOneBy(['email' => $email]);

        return ($this->passwordHasher->isPasswordValid($user, $password))
            ? $user
            : null;
    }

    public function setToken(User $user):? User
    {
        try {
            $token = ApiUtils::generateToken(64);
            $user->setApiToken($token);

            $this->entityManager->persist($user);
            $this->entityManager->flush();
        } catch (CreateTokenException $e) {
            error(getExceptionStr($e));
            return null;
        }

        return $user;
    }

    public function validateRequest(Request $request): bool
    {
        $email = trim((string) $request->request->get('user'));
        $password = trim((string) $request->request->get('password'));

        // TODO: apply validations

        return $email
            && $password
            && strlen($password) >= $this::MIN_PASSWORD_LENGTH;
    }
}
