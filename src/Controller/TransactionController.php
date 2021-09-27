<?php
declare(strict_types=1);

namespace App\Controller;

use App\Infrastructure\Repositories\sqlite\TransactionRepositorySqlite;
use App\Infrastructure\Services\TransactionService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TransactionController extends BaseController
{
    /**
     * @Route("/transaction", methods={"POST"})
     */
    public function transaction(Request $request): \Symfony\Component\HttpFoundation\JsonResponse
    {
        $data = $this->getJsonData($request);
        $repository = new TransactionRepositorySqlite($this->connection);
        return $this->json(
            (new TransactionService($repository)
            )->execute($data));
    }
}