<?php

namespace tests\Functional\App\Domain\Sensor\Controller\Api\V1;

use App\Domain\Sensor\Event\SensorEvent;
use App\Util\Misc\HttpStatusCode;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CreateSensorControllerTest extends WebTestCase
{
    private string $expectedMessage = SensorEvent::CREATE;
    private string $uri = '/api/v1/sensor';


    public function testCreateSensor(): void
    {
        $client = static::createClient();
        $client->request('POST', $this->uri, ['name' => 'OneTest']);

        $this->assertEquals(
            HttpStatusCode::CREATED,
            $client->getResponse()->getStatusCode()
        );
        $this->assertStringContainsString(
            $this->expectedMessage,
            $client->getResponse()->getContent()
        );
    }
}
