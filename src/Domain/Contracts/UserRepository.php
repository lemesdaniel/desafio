<?php
declare(strict_types=1);

namespace Challenge\Domain\Contracts;

use Challenge\Domain\User;

interface UserRepository
{
    public function create(User $user): void;
    public function findByDocument(Document $document): User;
}