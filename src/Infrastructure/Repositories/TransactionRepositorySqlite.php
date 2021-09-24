<?php
declare(strict_types=1);

namespace Challenge\Infrastructure\Repositories;

use Challenge\Domain\Contracts\TransactionRepository;
use Challenge\Domain\Contracts\User;

class TransactionRepositorySqlite implements TransactionRepository
{

    public function __construct(User $payer, User $payee, float $value)
    {
    }

    public function __invoke()
    {
        // TODO: Implement __invoke() method.
    }
}