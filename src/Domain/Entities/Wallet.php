<?php
declare(strict_types=1);

namespace Challenge\Domain\Entities;

class Wallet
{
    private User $user;
    private float $balance;
}