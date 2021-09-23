<?php
declare(strict_types=1);

namespace Challenge\Domain\Contracts;

interface HashPasswordInterface
{
    public function make(string $password): string;
    public function check(string $password, string $passwordHash): bool;
}