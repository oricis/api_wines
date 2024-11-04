<?php

declare(strict_types=1);

namespace App\Repository;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

class BaseRepository
{
    protected Connection $connection;
    protected string $attributes = '*';

    public function __construct(string $dbName = '')
    {
        $this->connection
            = DriverManager::getConnection($this->getConnectionParams($dbName));
    }

    public function setAttributes(array $attributes): void
    {
        $this->attributes = implode(',', $attributes);
    }

    public function getConnection(): Connection
    {
        return $this->connection;
    }


    private function getConnectionParams(string $dbName = ''): array
    {
        return [
            'dbname' => ($dbName) ? $dbName : $_ENV['DB_NAME'],
            'driver' => $_ENV['DB_DRIVER'],
            'host'   => $_ENV['DB_HOST'],
            'password' => $_ENV['DB_PASSWORD'],
            'server_version' => $_ENV['DB_SERVER_VERSION'],
            'user'   => $_ENV['DB_USER'],
        ];
    }
}
