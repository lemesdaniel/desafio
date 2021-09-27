<?php
declare(strict_types=1);

namespace App\Infrastructure\Services;

use App\Domain\Contracts\TransactionRepository;
use App\Domain\Contracts\UserRepository;
use App\Domain\Contracts\WalletRepository;


class TransactionService
{

    /**
     * @var \App\Domain\Contracts\TransactionRepository
     */
    private TransactionRepository $repository;
    /**
     * @var \App\Domain\Contracts\WalletRepository
     */
    private WalletRepository $walletRepository;
    /**
     * @var \App\Domain\Contracts\UserRepository
     */
    private UserRepository $userRepository;

    /**
     * @param \App\Domain\Contracts\TransactionRepository $repository
     * @param \App\Domain\Contracts\WalletRepository $walletRepository
     * @param \App\Domain\Contracts\UserRepository $userRepository
     */
    public function __construct(TransactionRepository $repository, WalletRepository $walletRepository, UserRepository $userRepository)
    {
        $this->repository = $repository;
        $this->walletRepository = $walletRepository;
        $this->userRepository = $userRepository;
    }

    public function execute($data)
    {
        $payer = $this->userRepository->find((int) $data->payer ?? null);;
        $payee = $this->userRepository->find((int) $data->payer ?? null);;
        $value = $data->payer ?? null;
    }
}