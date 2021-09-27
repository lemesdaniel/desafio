<?php

declare(strict_types=1);

namespace App\Infrastructure\Repositories\sqlite;

use App\Domain\Contracts\WalletRepository;
use App\Domain\Entities\Wallet;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;

class WalletRepositorySqlite implements WalletRepository
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
     * @param int $user
     * @return array
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws Exception
     */
    public function getBalance(int $user): array
    {
        $sql = 'SELECT user_id, balance FROM wallets WHERE user_id = :id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue('id', $user);
        $resultSet = $stmt->executeQuery();
        $wallet = $resultSet->fetchAssociative();

        if (!$wallet) {
            return [];
        }

        return $wallet;
    }

    /**
     * @throws Exception
     * @throws \Doctrine\DBAL\Driver\Exception
     */
    public function cashIn(Wallet $wallet): array
    {
        $this->checkIfExistsWallet($wallet);
        $sql = 'UPDATE wallets SET balance=balance+:value WHERE user_id = :user_id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue('value', $wallet->getBalance());
        $stmt->bindValue('user_id', $wallet->getUserId());
        $stmt->executeQuery();
        return $this->getBalance($wallet->getUserId());
    }

    /**
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws Exception
     */
    public function cashOut(Wallet $wallet): array
    {
        $this->checkIfExistsWallet($wallet);
        $sql = 'UPDATE wallets SET balance=balance-:value WHERE user_id = :user_id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue('value', $wallet->getBalance());
        $stmt->bindValue('user_id', $wallet->getUserId());
        $stmt->executeQuery();
        return $this->getBalance($wallet->getUserId());
    }

    /**
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws Exception
     */
    private function checkIfExistsWallet(Wallet $wallet): void
    {
        $sql = 'INSERT OR IGNORE INTO wallets (user_id, balance) VALUES (:user_id,0.0);';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue('user_id', $wallet->getUserId());
        $stmt->executeQuery();
    }
}