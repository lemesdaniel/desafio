<?php
declare(strict_types=1);

namespace App\Infrastructure\Repositories\sqlite;

use App\Domain\Contracts\UserRepository;
use App\Domain\Entities\User;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;

class UserRepositorySqlite implements UserRepository
{
    private Connection $connection;

    /**
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param User $user
     */
    public function save(User $user): array
    {
        $sql = 'INSERT INTO users (name, document, email, password) VALUES
                                (:name, :document, :email, :password)';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue('name', $user->getName());
        $stmt->bindValue('document', $user->getDocument());
        $stmt->bindValue('email', $user->getEmail());
        $stmt->bindValue('password', $user->getPassword());
        $stmt->executeQuery();
        $id = $this->connection->lastInsertId();
        return $this->find((int)$id);
    }

    /**
     * @param string $document
     * @return array
     * @throws Exception
     * @throws \Doctrine\DBAL\Driver\Exception
     */
    public function findByDocument(string $document): array
    {
        $sql = 'SELECT id, name, document, email FROM users WHERE id = :document';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue('document', $document);
        $resultSet = $stmt->executeQuery();
        $user = $resultSet->fetchAssociative();

        return (new User)
            ->load($user['id'], $user['name'], $user['email'], $user['document'])
            ->toArray();
    }

    /**
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws Exception
     */
    public function find(int $id): array
    {
        $sql = 'SELECT id, name, document, email FROM users WHERE id = ? LIMIT 1';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(1, $id);
        $resultSet = $stmt->executeQuery();
        $user = $resultSet->fetchAssociative();

        if(!$user){
            return [];
        }

        return (new User)
            ->load($user['id'], $user['name'], $user['email'], $user['document'])
            ->toArray();
    }
}