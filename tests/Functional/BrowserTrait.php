<?php

namespace App\Tests\Functional;

use Symfony\Component\HttpFoundation\Request;

trait BrowserTrait
{

    private function doRequest(
        string $method = 'GET',
        string $uri = '',
        array $data = []
    ): void
    {
        $this->client->request($method, $uri, $data);
    }

    private function getRequest(
        string $method = 'GET',
        string $uri = '',
        array $data = []
    ): Request
    {
        $this->doRequest($method, $uri, $data);

        return $this->client->getRequest();
    }
}
