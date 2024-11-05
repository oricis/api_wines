<?php

namespace App\Tests\Functional\App\Domain\Sensor\Controller\Api\V1;

use App\Domain\Sensor\Event\SensorEvent;
use App\Tests\Functional\BrowserTrait;
use App\Util\Misc\HttpStatusCode;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ListSensorControllerTest extends WebTestCase
{
    use BrowserTrait;

    /**
     * @var \Symfony\Bundle\FrameworkBundle\KernelBrowser $client
     */
    private KernelBrowser $client;

    private string $expectedMessage = SensorEvent::READ_ROWS;
    private string $uri = '/api/v1/sensor';


    protected function setUp(): void
    {
        parent::setUp();

        $this->client = static::createClient();
    }

    public function testGetSensorsIsAscendingOrder(): void
    {
        $this->doRequest('GET', $this->uri);

        $this->assertEquals(
            HttpStatusCode::OK,
            $this->client->getResponse()->getStatusCode()
        );

        $responseContent = $this->client->getResponse()->getContent();
        $this->assertStringContainsString(
            $this->expectedMessage,
            $responseContent
        );

        $arrResponseContent = json_decode($responseContent);
        $sensorNames = $this->getSensorNames($arrResponseContent->data->sensors);
        $this->assertIsArray($sensorNames);
        $this->assertNotEmpty($sensorNames);
        $this->assertEquals(
            array_values(sortAlphabetically($sensorNames)),
            array_values($sensorNames)
        );
    }


    private function getSensorNames(array $rows): array
    {
        return array_map(function ($row) {
            return $row->name;
        }, $rows);
    }
}
