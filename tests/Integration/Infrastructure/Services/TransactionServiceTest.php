<?php

declare(strict_types=1);
test(
    'Usuário payer não encontrado',
    function () {
        $repository = Mockery::mock(\App\Domain\Contracts\TransactionRepository::class);
        $walletRepositoty = Mockery::mock(\App\Domain\Contracts\WalletRepository::class);
        $userRepository = Mockery::mock(\App\Domain\Contracts\UserRepository::class);
        $userRepository->shouldReceive('find')->andReturn([], []);
        $authorizingService = Mockery::mock(\App\Domain\Contracts\AuthorizingService::class);
        $notification = Mockery::mock(\App\Domain\Contracts\Notification::class);
        $transaction = new \App\Infrastructure\Services\TransactionService(
            $repository, $walletRepositoty, $userRepository,
            $authorizingService, $notification
        );
        $data = [
            "payer" => 41,
            "payee" => 45,
            "value" => 189.99
        ];
        $transaction->execute((object)$data);
    }
)->expectExceptionCode(422)->expectExceptionMessage('Usuário pagador não foi encontrado');


test(
    'Usuário payee não encontrado',
    function () {
        $repository = Mockery::mock(\App\Domain\Contracts\TransactionRepository::class);
        $walletRepositoty = Mockery::mock(\App\Domain\Contracts\WalletRepository::class);
        $userRepository = Mockery::mock(\App\Domain\Contracts\UserRepository::class);
        $userRepository->shouldReceive('find')->andReturn([
            "id" => 38,
            "name" => "Daniel",
            "document" => "13777246620",
            "email" => "dlemesdev@gmail.com"
        ], []);
        $authorizingService = Mockery::mock(\App\Domain\Contracts\AuthorizingService::class);
        $notification = Mockery::mock(\App\Domain\Contracts\Notification::class);
        $transaction = new \App\Infrastructure\Services\TransactionService(
            $repository, $walletRepositoty, $userRepository,
            $authorizingService, $notification
        );
        $data = [
            "payer" => 41,
            "payee" => 45,
            "value" => 189.99
        ];
        $transaction->execute((object)$data);
    }
)->expectExceptionCode(422)->expectExceptionMessage('Usuário beneficiário não foi encontrado');


test(
    'Loja não pode enviar $ (CNPJ não envia)',
    function () {
        $repository = Mockery::mock(\App\Domain\Contracts\TransactionRepository::class);
        $walletRepositoty = Mockery::mock(\App\Domain\Contracts\WalletRepository::class);
        $userRepository = Mockery::mock(\App\Domain\Contracts\UserRepository::class);
        $userRepository->shouldReceive('find')->andReturn([
            "id" => 38,
            "name" => "Loja",
            "document" => "90549352000193",
            "email" => "dlemesdev@gmail.com"
        ], [
            "id" => 39,
            "name" => "Daniel",
            "document" => "13777246620",
            "email" => "email@gmail.com"
        ]);
        $authorizingService = Mockery::mock(\App\Domain\Contracts\AuthorizingService::class);
        $notification = Mockery::mock(\App\Domain\Contracts\Notification::class);
        $transaction = new \App\Infrastructure\Services\TransactionService(
            $repository, $walletRepositoty, $userRepository,
            $authorizingService, $notification
        );
        $data = [
            "payer" => 41,
            "payee" => 45,
            "value" => 189.99
        ];
        $transaction->execute((object)$data);
    }
)->expectExceptionCode(422)->expectExceptionMessage('Lojistas podem apenas receber transferências, não podem fazer');


test(
    'Verificando valores da transação',
    function ($amount) {
        $repository = Mockery::mock(\App\Domain\Contracts\TransactionRepository::class);
        $walletRepositoty = Mockery::mock(\App\Domain\Contracts\WalletRepository::class);
        $userRepository = Mockery::mock(\App\Domain\Contracts\UserRepository::class);
        $userRepository->shouldReceive('find')->andReturn([
            "id" => 38,
            "name" => "Daniel",
            "document" => "13777246620",
            "email" => "dlemesdev@gmail.com"
        ], [
            "id" => 39,
            "name" => "Loja teste",
            "document" => "90549352000193",
            "email" => "email@gmail.com"
        ]);
        $authorizingService = Mockery::mock(\App\Domain\Contracts\AuthorizingService::class);
        $notification = Mockery::mock(\App\Domain\Contracts\Notification::class);
        $transaction = new \App\Infrastructure\Services\TransactionService(
            $repository, $walletRepositoty, $userRepository,
            $authorizingService, $notification
        );
        $data = [
            "payer" => 41,
            "payee" => 45,
            "value" => $amount
        ];
        $transaction->execute((object)$data);
    }
)->with([
    -1,
    0,
    -150
])->expectExceptionCode(422)->expectExceptionMessage('Valor da transação precisa ser maior que zero.');

