<?php

declare(strict_types=1);

namespace App\Domain\Sensor\Service;

use App\Repository\BaseRepository;

class QuerySensorService extends BaseRepository
{
    private string $table = 'sensor';


    public function __construct(string $dbName = 'apiwines')
    {
        parent::__construct($dbName);
    }

    public function getRandomId(): int
    {
        $query  = 'SELECT id FROM ' . $this->table;
        $rows   = $this->connection->executeQuery($query)->fetchAllNumeric();
        $rowIds = array_merge(...$rows);

        return ($rowIds)
            ? $rowIds[rand(0, count($rowIds) - 1)]
            : 0;
    }
}
