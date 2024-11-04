<?php

namespace App\Tests\Functional\App\Domain\Sensor\Repository;

use App\Domain\Sensor\Repository\SensorRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;

class SensorRepositoryTest extends WebTestCase
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

    public function testListSensorsIsAscendingOrder(): void
    {
        $repository = $this->container->get(SensorRepository::class);
        $sensors = $repository->getAllInAscOrder();

        $this->assertIsArray($sensors);
        $this->assertCount($repository->count([]), $sensors);
    }
}
