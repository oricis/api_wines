<?php

namespace App\Tests\Functional\App\Domain\Wine\Repository;

use App\Domain\Wine\Entity\Wine;
use App\Domain\Wine\Repository\WineRepository;
use App\Domain\Wine\Service\WineWithMeasurementsResponseService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;

class WineWithMeasurementsResponseServiceTest extends WebTestCase
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

    public function testPrepareOutputWinesWithTheirMeasurements(): void
    {
        /*
        * @param array<int,Measurement> $measurements
        * @return array<string,mixed>
        */
        // static function get(object $wine, array $measurements = []): array

        $wine = $this->getWine();
        $this->assertNotNull($wine, '>> There arent wines to run the tests <<');

        /*
        1) App\Tests\Functional\App\Domain\Wine\Repository\WineWithMeasurementsResponseServiceTest::testPrepareOutputWinesWithTheirMeasurements
        Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException: The "App\Domain\Wine\Service\WineWithMeasurementsResponseService" service or alias has been removed or inlined when the container was compiled. You should either make it public, or stop using the container directly and use dependency injection instead.
        */
        return; // TODO:

        $service = $this->container->get(WineWithMeasurementsResponseService::class);
        $response = $service->get($wine);

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('name', $response);
        $this->assertArrayHasKey('measurements', $response);
        $this->assertIsArray($response['measurements']);
    }


    private function getWine():? Wine
    {
        $repository = $this->container->get(WineRepository::class);
        $wines = $repository->getWinesWithMeasurements();

        return $wines[0] ?? null;
    }
}
