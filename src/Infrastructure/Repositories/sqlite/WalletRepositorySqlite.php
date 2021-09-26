<?php
declare(strict_types=1);

namespace App\Infrastructure\Repositories\sqlite;

use Doctrine\DBAL\Connection;

class WalletRepositorySqlite
{
    /**
     * @var Connection
     */
    private Connection $connection;

    /**
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }
}