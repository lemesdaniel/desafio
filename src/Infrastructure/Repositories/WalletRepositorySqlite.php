<?php
declare(strict_types=1);

namespace Challenge\Infrastructure\Repositories;

use Challenge\Domain\Contracts\User;
use Challenge\Domain\Contracts\WalletRepository;

class WalletRepositorySqlite implements WalletRepository
{

    public function __construct(User $user)
    {
    }

    public function getBalance(): float
    {
        // TODO: Implement getBalance() method.
        return 0.00;
    }
}