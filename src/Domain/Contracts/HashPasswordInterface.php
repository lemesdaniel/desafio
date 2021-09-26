<?php
declare(strict_types=1);

namespace App\Domain\Contracts;

interface HashPasswordInterface
{
    /**
     * @param string $password
     * @return string
     */
    public function make(string $password): string;

    /**
     * @param string $password
     * @param string $passwordHash
     * @return bool
     */
    public function check(string $password, string $passwordHash): bool;
}