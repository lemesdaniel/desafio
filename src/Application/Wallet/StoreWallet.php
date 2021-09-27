<?php
declare(strict_types=1);

namespace App\Application\Wallet;

use App\Domain\Contracts\WalletRepository;
use App\Domain\Entities\Wallet;

class StoreWallet
{
    /**
     * @var WalletRepository
     */
    private WalletRepository $repository;

    /**
     * @param \App\Domain\Contracts\WalletRepository $repository
     */
    public function __construct(WalletRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \App\Application\Wallet\WalletDto $walletDto
     * @return array
     */
    public function execute(WalletDto $walletDto): array
    {
        $wallet = (new Wallet())->create($walletDto->user_id, $walletDto->balance);
        return  $this->repository->addFunds($wallet);
    }

    public function load()
    {
        
    }

}