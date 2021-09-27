<?php
declare(strict_types=1);

namespace App\Controller;

use App\Infrastructure\Repositories\sqlite\TransactionRepositorySqlite;
use App\Infrastructure\Repositories\sqlite\UserRepositorySqlite;
use App\Infrastructure\Repositories\sqlite\WalletRepositorySqlite;
use App\Infrastructure\Services\TransactionService;
use Doctrine\DBAL\Driver\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TransactionController extends BaseController
{
    /**
     * @Route("/transaction", methods={"POST"})
     * @throws \Exception
     */
    public function transaction(Request $request): \Symfony\Component\HttpFoundation\JsonResponse
    {
        $data = $this->getJsonData($request);
        $repository = new TransactionRepositorySqlite($this->connection);
        $walletRepositoty = new WalletRepositorySqlite($this->connection);
        $userRepository = new UserRepositorySqlite($this->connection);
        $this->connection->beginTransaction();
        try {
            (new TransactionService($repository, $walletRepositoty, $userRepository))->execute($data);
            $this->connection->commit();

        } catch (Exception $exception) {
            $this->connection->rollBack();
            return $this->json(["message"=>" Transação falhou "]);
        }

        return $this->json(["message"=>"Sucesso na transação"]);
    }
}