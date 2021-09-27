<?php

declare(strict_types=1);

namespace App\Infrastructure\Services;

use App\Application\Wallet\StoreWallet;
use App\Application\Wallet\WalletDto;
use App\Infrastructure\Repositories\sqlite\UserRepositorySqlite;
use App\Infrastructure\Repositories\sqlite\WalletRepositorySqlite;

class WalletService
{
    /**
     * @var WalletRepositorySqlite
     */
    private WalletRepositorySqlite $repository;
    /**
     * @var \App\Infrastructure\Repositories\sqlite\UserRepositorySqlite
     */
    private UserRepositorySqlite $userRepository;

    /**
     * @param WalletRepositorySqlite $repository
     */
    public function __construct(WalletRepositorySqlite $repository, UserRepositorySqlite $userRepository)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
    }

    /**
     * @throws \Exception
     */
    public function execute($data)
    {
        $user = $this->userExists((int)$data->user_id);
        if (!$user) {
            throw new \Exception("Usuário não existe");
        }
        $wallet = new WalletDto($data->user_id, (float)$data->value);
        return (new StoreWallet($this->repository))->execute($wallet);
    }

    /**
     * @param $id
     * @return bool
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws \Doctrine\DBAL\Exception
     */
    public function userExists($id): bool
    {
        return (bool)$this->userRepository->find($id);
    }

    /**
     * @param $data
     * @return array
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws \Doctrine\DBAL\Exception
     */
    public function getBalance($data): array
    {
        $user = $this->userExists((int)$data->user_id);
        if (!$user) {
            throw new \Exception("Usuário não existe");
        }
        $wallet = new WalletDto($data->user_id, 0.0);
        return (new StoreWallet($this->repository))->getBalance($wallet);
    }
}