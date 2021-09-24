<?php

namespace Challenge\Domain\Contracts;

interface WalletRepository
{

    public function __construct(User $user);
    public function getBalance(): float;
}