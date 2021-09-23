<?php
declare(strict_types=1);

namespace Challenge\Domain\Entities;

class Transaction
{
    private User $payer;
    private User $payee;
    private float $value;
}