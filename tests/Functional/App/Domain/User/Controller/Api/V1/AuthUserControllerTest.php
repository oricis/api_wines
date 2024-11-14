<?php

namespace App\Tests\Functional\App\Domain\User\Controller\Api\V1;

use App\Domain\User\Event\UserEvent;
use App\Tests\Functional\BrowserTrait;
use App\Util\Misc\HttpStatusCode;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AuthUserControllerTest extends WebTestCase
{
    use BrowserTrait;

    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    private $container;

    /**
     * @var \Symfony\Bundle\FrameworkBundle\KernelBrowser $client
     */
    private KernelBrowser $client;

    private string $uri = '/api/v1/login';


    protected function setUp(): void
    {
        parent::setUp();

        $this->client = static::createClient();
        $this->container = $this->client->getContainer();
    }

    public function testLoginError(): void
    {
        $data = [
            'user' => 'user1@mail.com',
            // 'password' => '12345678', // NOTE: required
        ];
        $this->doRequest('POST', $this->uri, $data);

        $this->assertEquals(
            HttpStatusCode::VALIDATION_ERROR,
            $this->client->getResponse()->getStatusCode()
        );
        $this->assertStringContainsString(
            UserEvent::LOGIN_ERROR,
            $this->client->getResponse()->getContent()
        );
    }

    public function testLoginOk(): void
    {
        $data = [
            'user' => 'user_1@mail.com',
            'password' => '12345678',
        ];
        $this->doRequest('POST', $this->uri, $data);

        $this->assertEquals(
            HttpStatusCode::OK,
            $this->client->getResponse()->getStatusCode()
        );
        $this->assertStringContainsString(
            UserEvent::LOGIN,
            $this->client->getResponse()->getContent()
        );
    }
}
