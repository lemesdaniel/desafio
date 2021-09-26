<?php
declare(strict_types=1);

namespace App\Controller;

use App\Infrastructure\Services\UserService;
use App\Infrastructure\Repositories\sqlite\UserRepositorySqlite;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends BaseController
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @Route("/user",methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $data = $this->getJsonData($request);
        $repository = new UserRepositorySqlite($this->connection);
        return $this->json(
            (new UserService($repository)
            )->execute($data));
    }

    /**
     * @Route("/user/{id}", methods={"GET"})
     * @param int $id
     * @return JsonResponse
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws \Doctrine\DBAL\Exception
     */
    public function get($id): JsonResponse
    {
       $resultData = (new UserRepositorySqlite($this->connection))->find((int) $id);

       return $this->json($resultData);
    }

}