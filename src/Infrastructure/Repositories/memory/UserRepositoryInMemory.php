<?php
declare(strict_types=1);

namespace App\Infrastructure\Repositories\memory;

use App\Domain\Contracts\UserRepository;
use App\Domain\Entities\User;

class UserRepositoryInMemory implements UserRepository
{
    private array $users = [];

    public function save(User $user): array
    {
        $index = (int) $user->getDocument();
        $this->users[$index] = [
            'name' => $user->getName(),
            'document' => $user->getDocument(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
        ];
        return $this->find($index);
    }

    public function findByDocument(string $document): array
    {
        // TODO: Implement findByDocument() method.
        return [];
    }

    public function find(int $id): array
    {
        $user = $this->users[$id];
        return (new User)
            ->load($user['id'], $user['name'], $user['email'], $user['document'])
            ->toArray();
    }
}