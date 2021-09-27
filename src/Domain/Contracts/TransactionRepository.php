<?php

namespace App\Domain\Contracts;

use App\Domain\Entities\User;

interface TransactionRepository
{


    /**
     * @return mixed
     */
    public function execute(int $payer_id, int $payee_id, float $value);
}