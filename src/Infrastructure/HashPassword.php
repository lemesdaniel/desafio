<?php
declare(strict_types=1);

namespace Challenge\Infrastructure;

use Challenge\Domain\Contracts\HashPasswordInterface;

class HashPassword implements HashPasswordInterface
{

    public function make(string $password): string
    {
        return password_hash($password, PASSWORD_ARGON2ID);
    }

    public function check(string $password, string $passwordHash): bool
    {
        return password_verify($password, $passwordHash);
    }
}