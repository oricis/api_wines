<?php

namespace App\Domain\User\Controller\Api\V1;

use App\Domain\User\Event\UserEvent;
use App\Domain\User\Service\AuthenticateUserResponseService;
use App\Domain\User\Service\AuthUserService;
use App\Util\Misc\HttpStatusCode;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AuthUserController extends AbstractController
{

    #[Route('/api/v1/login', name: 'api_login', methods: ['POST'])]
    public function login(
        AuthUserService $authUserService,
        Request $request
    ): JsonResponse
    {
        $statusCode = HttpStatusCode::OK;
        if (!$authUserService->validateRequest($request)) {
            $statusCode = HttpStatusCode::VALIDATION_ERROR;
        }

        if ($statusCode === HttpStatusCode::OK) {
            $user = $authUserService->login($request);
            if (is_null($user)) {
                $statusCode = HttpStatusCode::UNAUTHORIZED;
            } else {
                $user = $authUserService->setToken($user);
                if (is_null($user->getApiToken())) {
                    $statusCode = HttpStatusCode::TEAPOT;
                }
            }
        }

        $user = ($user ?? null)
            ? AuthenticateUserResponseService::get($user)
            : null;

        $output = [
            'message' => $this->getLoginMessage($statusCode),
            'data' => [
                'user' => $user,
            ],
        ];

        return new JsonResponse($output, $statusCode);
    }


    private function getLoginMessage(int $statusCode): string
    {
        return ($statusCode === HttpStatusCode::OK)
            ? UserEvent::LOGIN
            : UserEvent::LOGIN_ERROR;
    }
}
