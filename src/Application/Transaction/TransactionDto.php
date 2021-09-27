<?php
declare(strict_types=1);

namespace App\Application\Transaction;

class TransactionDto
{
    /**
     * @var int
     */
    public int $payer;
    /**
     * @var int
     */
    public int $payee;
    /**
     * @var float
     */
    public float $value;

    /**
     * @param int $payer
     * @param int $payee
     * @param float $value
     */
    public function __construct(int $payer, int $payee, float $value)
    {
        $this->payer = $payer;
        $this->payee = $payee;
        $this->value = $value;
    }
}