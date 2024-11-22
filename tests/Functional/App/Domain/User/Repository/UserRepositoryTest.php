<?php

namespace App\Tests\Functional\App\Domain\User\Repository;

use App\Domain\User\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;

class UserRepositoryTest extends WebTestCase
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    private $container;

    /**
     * @var \Symfony\Bundle\FrameworkBundle\KernelBrowser $client
     */
    private KernelBrowser $client;


    protected function setUp(): void
    {
        parent::setUp();

        $this->client = static::createClient();
        $this->container = $this->client->getContainer();
    }

    public function testGetUserByEmailFailure(): void
    {
        $unregisteredEmail = 'loremipsum@loremlorem.php';
        $repository = $this->container->get(UserRepository::class);
        $user = $repository->getUserFromEmail($unregisteredEmail);

        $this->assertNull($user);
    }
}
