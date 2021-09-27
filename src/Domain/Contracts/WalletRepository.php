<?php

namespace App\Domain\Contracts;

use App\Domain\Entities\User;
use App\Domain\Entities\Wallet;

interface WalletRepository
{
    /**
     * @param int $user
     * @return array
     */
    public function getBalance(int $user): array;

    /**
     * @param float $value
     * @return array
     */
    public function addFunds(Wallet $wallet): array;

}