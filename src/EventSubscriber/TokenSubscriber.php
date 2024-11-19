<?php

namespace App\EventSubscriber;

use App\Domain\User\Controller\Api\V1\AuthUserController;
use App\Domain\User\Repository\UserRepository;
use App\Domain\User\Service\AuthenticateUserResponseService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Controller\ErrorController;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

class TokenSubscriber implements EventSubscriberInterface
{

    public function __construct(private UserRepository $userRepository)
    {
         // content
    }

    public function onKernelController(ControllerEvent $event): void
    {
        /**
         * @var array<int,mixed>|ErrorController
         */
        $controller = $event->getController();

        /**
         * @var string
         */
        $controllerClass = '';
        if (is_array($controller) && is_object($controller[0])) {
            $controllerClass = get_class($controller[0]);
        } elseif (is_object($controller)) {
            $controllerClass = get_class($controller);
        }

        /**
         * @var string
         */
        $methodName = is_array($controller)
            ? $controller[1]
            : '';

        /**
         * @var \Symfony\Component\HttpFoundation\HeaderBag
         */
        $headers = $event->getRequest()->headers;

        /**
         * @var string
         */
        $apiToken = $headers->get('apitoken');

        //dump($controllerClass, 'method: ' . $methodName, $apiToken); // HACK:

        if ($apiToken !== $_ENV['API_TOKEN']) {
            throw new AccessDeniedHttpException('The api token is invalid!');
        }

        if ($controllerClass !== AuthUserController::class
            && $methodName !== 'login') {

            // Check if authenticated

            $authToken = $headers->get('token');
            if (is_null($authToken)) {
                throw new AccessDeniedHttpException('Unauthorized!');
            }

            $user = $this->userRepository->getUserFromApiToken($authToken);
            if (is_null($user)) {
                throw new AccessDeniedHttpException('Invalid auth token!');
            }
            $userData = AuthenticateUserResponseService::get($user);

            $session = $event->getRequest()->getSession();
            $session->set('user', $userData);
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}
