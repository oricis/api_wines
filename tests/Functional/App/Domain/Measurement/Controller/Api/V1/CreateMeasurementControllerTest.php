<?php

namespace App\Tests\Functional\App\Domain\Measurement\Controller\Api\V1;

use App\Domain\Measurement\Event\MeasurementEvent;
use App\Util\Misc\HttpStatusCode;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Tests\Functional\App\Domain\Measurement\CreateMeasurementTrait;
use App\Tests\Functional\BrowserTrait;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;

class CreateMeasurementControllerTest extends WebTestCase
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

    private string $expectedMessage = MeasurementEvent::CREATE;
    private string $uri = '/api/v1/measurement';


    protected function setUp(): void
    {
        parent::setUp();

        $this->client = static::createClient();
        $this->container = $this->client->getContainer();
    }

    public function testCreateMeasurement(): void
    {
        $this->doRequest('POST', $this->uri, $this->getData());

        $this->assertEquals(
            HttpStatusCode::CREATED,
            $this->client->getResponse()->getStatusCode()
        );
        $this->assertStringContainsString(
            $this->expectedMessage,
            $this->client->getResponse()->getContent()
        );
    }
}
