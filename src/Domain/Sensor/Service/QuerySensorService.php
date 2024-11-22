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

        /**
         * @var array<int,int>
         */
        $rowIds = array_merge(...$rows);
        $totalRows = count($rowIds);

        return ($totalRows)
            ? $rowIds[rand(0, $totalRows - 1)]
            : 0;
    }
}
