<?php
declare(strict_types=1);

namespace App\Application\Wallet;

class WalletDto
{

    /**
     * @var string
     */
    public string $user_id;
    /**
     * @var string
     */
    public float $balance;

    /**
     * @param string $user_id
     * @param string $balance
     */
    public function __construct(string $user_id, float $balance)
    {
        $this->user_id = $user_id;
        $this->balance = $balance;
    }


}