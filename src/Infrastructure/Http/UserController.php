<?php
declare(strict_types=1);

namespace Challenge\Infrastructure\Http;

use Challenge\Application\User\StoreUser;
use Challenge\Application\User\UserDto;
use Challenge\Domain\Contracts\UserRepository;

class UserController
{
    private UserRepository $repository;

    /**
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     */
    public function store(array $data)
    {
        $document = $data['document'] ?? '';
        $name = $data['name'] ?? '';
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';
        $user = new UserDto($document, $name, $email, $password);
        return (new StoreUser($this->repository))->execute($user);
    }


}