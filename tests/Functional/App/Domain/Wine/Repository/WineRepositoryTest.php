<?php

namespace App\Tests\Functional\App\Domain\Wine\Repository;

use App\Domain\Wine\Repository\WineRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;

class WineRepositoryTest extends WebTestCase
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

    public function testListWinesWithTheirMeasurements(): void
    {
        $repository = $this->container->get(WineRepository::class);
        $wines = $repository->getWinesWithMeasurements();

        $this->assertIsArray($wines);
        $this->assertCount($repository->count([]), $wines);
    }
}
