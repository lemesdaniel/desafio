<?php
declare(strict_types=1);

namespace App\Domain\Entities;

class Wallet
{
    private int $user_id;
    private float $balance;

    /**
     * @param $user_id
     * @param $value
     * @return \App\Domain\Entities\Wallet
     */
    public function create($user_id, $value): Wallet
    {
        $this->setUserId($user_id);
        $this->setBalance($value);
        return $this;
    }

    /**
     * @param int $user_id
     * @return Wallet
     */
    public function setUserId($user_id): Wallet
    {
        $this->user_id = (int) $user_id;
        return $this;
    }

    /**
     * @param float $balance
     * @return Wallet
     */
    public function setBalance($balance): Wallet
    {
        $this->balance = (float) $balance;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @return float
     */
    public function getBalance(): float
    {
        return $this->balance;
    }
}