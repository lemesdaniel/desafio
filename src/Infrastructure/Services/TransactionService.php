<?php

declare(strict_types=1);

namespace App\Infrastructure\Services;

use App\Domain\Contracts\AuthorizingService;
use App\Domain\Contracts\Notification;
use App\Domain\Contracts\TransactionRepository;
use App\Domain\Contracts\UserRepository;
use App\Domain\Contracts\WalletRepository;
use App\Domain\Entities\Wallet;
use Exception;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class TransactionService
{

    /**
     * @var TransactionRepository
     */
    private TransactionRepository $repository;
    /**
     * @var WalletRepository
     */
    private WalletRepository $walletRepository;
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;
    private array $payer;
    private array $payee;
    private float $value;
    private AuthorizingService $authorizingService;
    /**
     * @var Notification
     */
    private Notification $notification;

    /**
     * @param TransactionRepository $repository
     * @param WalletRepository $walletRepository
     * @param UserRepository $userRepository
     */
    public function __construct(
        TransactionRepository $repository,
        WalletRepository $walletRepository,
        UserRepository $userRepository,
        AuthorizingService $authorizingService,
        Notification $notification
    ) {
        $this->repository = $repository;
        $this->walletRepository = $walletRepository;
        $this->userRepository = $userRepository;
        $this->authorizingService = $authorizingService;
        $this->notification = $notification;
    }

    /**
     * @param $data
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws \Doctrine\DBAL\Exception
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function execute($data)
    {
        $this->payer = $this->userRepository->find((int)$data->payer ?? null);
        $this->payee = $this->userRepository->find((int)$data->payee ?? null);
        $this->value = (float)$data->value ?? 0.0;
        $this->validate();
        $this->checkBalance();
        $this->cashOut();
        $this->cashIn();
        $this->registerTransaction();
        $this->authorizingService();
        $this->notificationService($this->payer);
        $this->notificationService($this->payee);
    }

    /**
     * @throws Exception
     */
    public function validate()
    {
        if (!$this->payer) {
            throw new Exception("Usuário pagador não foi encontrado", 422);
        }
        if (!$this->payee) {
            throw new Exception("Usuário beneficiário não foi encontrado", 422);
        }
        if (strlen($this->payee['document']) == 11) {
            throw new Exception("Usuário beneficiário precisa ser um lojista (possuir CNPJ)", 422);
        }
        if ($this->value <= 0.0) {
            throw new Exception("Valor da transação precisa ser maior que zero.", 422);
        }
    }

    public function checkBalance()
    {
        $balance = $this->walletRepository->getBalance((int)$this->payer['id']);
        if ((float)$balance['balance'] < $this->value) {
            throw new Exception("Saldo insuficiente", 422);
        }
    }

    /**
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws \Doctrine\DBAL\Exception
     */
    private function cashOut(): void
    {
        $wallet = (new Wallet())->create($this->payer['id'], $this->value);
        $this->walletRepository->cashOut($wallet);
    }

    /**
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws \Doctrine\DBAL\Exception
     */
    private function cashIn()
    {
        $wallet = (new Wallet())->create($this->payee['id'], $this->value);
        $this->walletRepository->cashIn($wallet);
    }

    private function registerTransaction()
    {
        $this->repository->execute((int)$this->payer['id'], (int)$this->payee['id'], $this->value);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @throws Exception
     */
    private function authorizingService(): void
    {
        $this->authorizingService->execute();
    }

    private function notificationService($user): void
    {
        $this->notification->execute($user);
    }


}