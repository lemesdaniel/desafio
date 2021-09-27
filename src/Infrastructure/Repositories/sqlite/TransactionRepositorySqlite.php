<?php

declare(strict_types=1);

namespace App\Infrastructure\Repositories\sqlite;


use App\Domain\Contracts\TransactionRepository;
use App\Domain\Entities\User;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;

class TransactionRepositorySqlite implements TransactionRepository
{

    /**
     * @var Connection
     */
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }


    /**
     * @param int $payer_id
     * @param int $payee_id
     * @param float $value
     * @return void
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws Exception
     */
    public function execute(int $payer_id, int $payee_id, float $value)
    {
        $sql = 'INSERT INTO transactions (payer_id, payee_id, value) VALUES
                                (:payer_id, :payee_id, :value)';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue('payer_id', $payer_id);
        $stmt->bindValue('payee_id', $payee_id);
        $stmt->bindValue('value', $value);
        $stmt->executeQuery();
    }
}