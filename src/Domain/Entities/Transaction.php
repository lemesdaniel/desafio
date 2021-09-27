<?php
declare(strict_types=1);

namespace App\Domain\Entities;

class Transaction
{
    /**
     * @var \App\Domain\Entities\User
     */
    private User $payer;
    /**
     * Apenas recebe
     * @var \App\Domain\Entities\User
     */
    private User $payee;
    /**
     * @var float
     */
    private float $value;
}