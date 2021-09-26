<?php

namespace App\Domain\Contracts;

use App\Domain\Entities\User;

interface WalletRepository
{

    /**
     * @param User $user
     */
    public function __construct(User $user);

    /**
     * @return float
     */
    public function getBalance(): float;

    /**
     * @param float $value
     * @return float
     */
    public function addFunds(float $value):float;

}