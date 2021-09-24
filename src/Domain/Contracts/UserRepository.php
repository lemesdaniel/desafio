<?php
declare(strict_types=1);

namespace Challenge\Domain\Contracts;

use Challenge\Domain\Document;
use Challenge\Domain\Entities\User;

interface UserRepository
{
    public function save(User $user): void;
    public function findByDocument(string $document): User;
}