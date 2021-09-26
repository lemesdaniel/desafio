<?php
declare(strict_types=1);

namespace App\Infrastructure\Services;
use App\Infrastructure\Repositories\sqlite\WalletRepositorySqlite;

class WalletService
{
    /**
     * @var WalletRepositorySqlite
     */
    private WalletRepositorySqlite $repository;

    /**
     * @param WalletRepositorySqlite $repository
     */
    public function __construct(WalletRepositorySqlite $repository)
    {
        $this->repository = $repository;
    }

    public function execute($data)
    {
    }
}