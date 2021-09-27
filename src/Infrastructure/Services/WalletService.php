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
        $user = $this->userExists((int) $data->user_id);
        if(!$user){
            throw new \Exception("Usuário não existe");
        }
        $wallet = new WalletDto($data->user_id, $data->value);
        return (new StoreWallet($this->repository))->execute($wallet);

    }

    /**
     * @return bool
     */
    public function userExists($id): bool
    {

        return (bool) $this->userRepository->find($id);
    }
}