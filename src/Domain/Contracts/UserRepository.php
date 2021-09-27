<?php
declare(strict_types=1);

namespace App\Domain\Contracts;

use App\Domain\Document;
use App\Domain\Entities\User;

interface UserRepository
{
    /**
     * @param User $user
     * @return array
     */
    public function save(User $user): array;

    /**
     * @param string $document
     * @return array
     */
    public function findByDocument(string $document): array;

    /**
     * @param int $id
     * @return array
     */
    public function find(int $id): array;
}