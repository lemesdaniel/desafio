<?php
declare(strict_types=1);

namespace App\Controller;

use App\Infrastructure\Repositories\sqlite\UserRepositorySqlite;
use App\Infrastructure\Repositories\sqlite\WalletRepositorySqlite;
use App\Infrastructure\Services\WalletService;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class WalletController extends BaseController
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
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
        $repository = new WalletRepositorySqlite($this->connection);
        $userRepository = new UserRepositorySqlite($this->connection);
        return $this->json(
            (new WalletService($repository, $userRepository)
            )->execute($data));
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
        $repository = new WalletRepositorySqlite($this->connection);
        $userRepository = new UserRepositorySqlite($this->connection);
        return $this->json(
            (new WalletService($repository, $userRepository)
            )->getBalance($data));
    }

}