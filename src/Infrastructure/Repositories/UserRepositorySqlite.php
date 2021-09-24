<?php
declare(strict_types=1);

namespace Challenge\Infrastructure\Repositories;

use Challenge\Domain\Contracts\UserRepository;
use Challenge\Domain\Entities\User;
use PDO;


class UserRepositorySqlite implements UserRepository
{

    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param User $user
     */
    public function save(User $user): void
    {
        $sql = 'INSERT INTO users (name, document, email, password) VALUES (:name, :document, :email, :password)';
        $data = [];
        $data['name'] = $user->getName();
        $data['document']  = $user->getDocument();
        $data['email'] = $user->getEmail();
        $data['password'] = $user->getPassword();
        $stmt= $this->connection->prepare($sql);
        $stmt->execute($data);
    }

    /**
     * @param string $document
     * @return User
     */
    public function findByDocument(string $document): User
    {
        $user = $this->mapper->findone([
           'document' => $document
        ]);
        return (new User)->load($user->name, $user->email, $user->document);
    }
}