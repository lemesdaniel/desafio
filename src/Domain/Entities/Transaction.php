<?php

declare(strict_types=1);

namespace App\Domain\Entities;

class Transaction
{
    /**
     * @var User
     */
    private User $payer;
    /**
     * Apenas recebe
     * @var User
     */
    private User $payee;
    /**
     * @var float
     */
    private float $value;
}