<?php
declare(strict_types=1);

namespace App\Infrastructure\Services;

use App\Application\Wallet\StoreWallet;
use App\Application\Wallet\WalletDto;
use App\Domain\Contracts\TransactionRepository;
use App\Domain\Contracts\UserRepository;
use App\Domain\Contracts\WalletRepository;
use App\Domain\Entities\Wallet;
use Doctrine\DBAL\Driver\Exception;


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
    private array $payer;
    private array $payee;
    private float $value;

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

    /**
     * @throws \Exception
     * @throws \Doctrine\DBAL\Driver\Exception
     */
    public function execute($data)
    {
        $this->payer = $this->userRepository->find((int)$data->payer ?? null);
        $this->payee = $this->userRepository->find((int)$data->payee ?? null);
        $this->value = (float) $data->value ?? 0.0;
        $this->validate();
        $this->checkBalance();
        $this->cashOut();
        $this->cashIn();
        $this->registerTransaction();
    }

    /**
     * @throws \Exception
     */
    public function validate(){
        if (!$this->payer) {
            throw new \Exception("Usuário pagador não foi encontrado", 422);
        }
        if (!$this->payee) {
            throw new \Exception("Usuário beneficiário não foi encontrado", 422);
        }
        if (strlen($this->payee['document']) == 11) {
            throw new \Exception("Usuário beneficiário precisa ser um lojista (possuir CNPJ)", 422);
        }
        if ($this->value <= 0.0 )
        {
            throw new \Exception("Valor da transação precisa ser maior que zero.", 422);
        }
    }

    public function checkBalance()
    {
        $balance = $this->walletRepository->getBalance((int) $this->payer['id']);
        if((float) $balance['balance'] < $this->value ){
            throw new \Exception("Saldo insuficiente", 422);
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
        $this->repository->execute((int) $this->payer['id'], (int) $this->payee['id'], $this->value);
    }

    private function authorizingService(){
        $httpClient = HttpClient::create();
        $response = $httpClient->request('GET', 'https://api.github.com/repos/symfony/symfony-docs');
    }

}