<?php

namespace Challenge\Domain\Contracts;

interface TransactionRepository
{
    public function __construct(User $payer, User $payee, float $value);
    public function __invoke();
}