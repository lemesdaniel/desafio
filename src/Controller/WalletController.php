<?php

declare(strict_types=1);

namespace App\Controller;

use App\Infrastructure\Repositories\sqlite\UserRepositorySqlite;
use App\Infrastructure\Repositories\sqlite\WalletRepositorySqlite;
use App\Domain\Exception\WalletService;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class WalletController extends BaseController
{
    /**
     * @var \App\Infrastructure\Repositories\sqlite\WalletRepositorySqlite
     */
    private WalletRepositorySqlite $repository;
    /**
     * @var \App\Infrastructure\Repositories\sqlite\UserRepositorySqlite
     */
    private UserRepositorySqlite $userRepository;

    /**
     * @param \Doctrine\DBAL\Connection $connection
     */
    public function __construct(Connection $connection)
    {
        parent::__construct($connection);
        $this->repository = new WalletRepositorySqlite($this->connection);
        $this->userRepository = new UserRepositorySqlite($this->connection);
    }

    /**
     * @Route("/wallet", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function addFound(Request $request): JsonResponse
    {
        $data = $this->getJsonData($request);
        return $this->json(
            (new WalletService($this->repository, $this->userRepository)
            )->execute($data)
        );
    }

    /**
     * @Route("/wallet", methods={"GET"})
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws \Exception
     */
    public function getBalance(Request $request): JsonResponse
    {
        $data = $this->getJsonData($request);
        return $this->json(
            (new WalletService($this->repository, $this->userRepository)
            )->getBalance($data)
        );
    }

}