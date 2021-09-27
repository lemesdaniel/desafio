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
     * @param \App\Domain\Entities\Wallet $wallet
     * @return array
     */
    public function cashIn(Wallet $wallet): array;

}