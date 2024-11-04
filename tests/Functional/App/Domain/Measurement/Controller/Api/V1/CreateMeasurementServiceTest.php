<?php

namespace App\Tests\Functional\App\Domain\Measurement\Controller\Api\V1;

use App\Domain\Measurement\Service\CreateMeasurementService;
use App\Tests\Functional\App\Domain\Measurement\CreateMeasurementTrait;
use App\Tests\Functional\BrowserTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;

class CreateMeasurementServiceTest extends WebTestCase
{
    use BrowserTrait;
    use CreateMeasurementTrait;

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

    public function testCreateMeasurement(): void
    {
        $data = $this->getData();
        $request = $this->getRequest('POST', '', $data);

        $service = $this->container->get(CreateMeasurementService::class);
        $measurement = $service->create($request);

        $this->assertNotNull($measurement);
        $this->assertEquals($data['color'], $measurement->getColor());
        $this->assertEquals($data['ph'], $measurement->getPh());
    }
}
