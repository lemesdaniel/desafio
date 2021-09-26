<?php

namespace App\Domain\Contracts;

use App\Domain\Entities\User;

interface TransactionRepository
{
    /**
     * @param User $payer
     * @param User $payee
     * @param float $value
     */
    public function __construct(User $payer, User $payee, float $value);

    /**
     * @return bool
     */
    public function validateTransaction():bool;

    /**
     * @return mixed
     */
    public function execute();
}