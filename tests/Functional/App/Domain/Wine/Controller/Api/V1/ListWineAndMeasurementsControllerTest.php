<?php

namespace App\Tests\Functional\App\Domain\Wine\Controller\Api\V1;

use App\Domain\Wine\Event\WineEvent;
use App\Domain\Wine\Repository\WineRepository;
use App\Tests\Functional\BrowserTrait;
use App\Util\Misc\HttpStatusCode;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ListWineAndMeasurementsControllerTest extends WebTestCase
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

    private string $expectedMessage = WineEvent::READ_ROWS;
    private string $uri = '/api/v1/wine/measurement';


    protected function setUp(): void
    {
        parent::setUp();

        $this->client = static::createClient();
        $this->container = $this->client->getContainer();
    }

    public function testGetWinesWithTheirMeasurements(): void
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
        $wineNames = $this->getWineNames($arrResponseContent->data->wines);
        $this->assertIsArray($wineNames);
        $this->assertNotEmpty($wineNames);
        $this->assertTrue($arrResponseContent->data->total > 0);
        $this->assertEquals($this->getWineTotal(), (int) $arrResponseContent->data->total);

        $this->assertIsArray($arrResponseContent->data->wines);
        $this->assertNotEmpty($arrResponseContent->data->wines);
        $this->assertObjectHasProperty('measurements', $arrResponseContent->data->wines[0]);

        $this->assertIsArray($arrResponseContent->data->wines[0]->measurements);
        $this->assertNotEmpty($arrResponseContent->data->wines[0]->measurements);
        $this->assertObjectHasProperty('temperature', $arrResponseContent->data->wines[0]->measurements[0]);
    }


    private function getWineNames(array $rows): array
    {
        return array_map(function ($row) {
            return $row->name;
        }, $rows);
    }

    private function getWineTotal(): int
    {
        $repository = $this->container->get(WineRepository::class);

        return $repository->count([]);
    }
}
