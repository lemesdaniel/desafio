<?php
declare(strict_types=1);

namespace Challenge\Application\User;

use Challenge\Domain\Contracts\UserRepository;
use Challenge\Domain\Entities\User;

class StoreUser
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
     * @param UserDto $user
     */
    public function execute(UserDto $user): void
    {
        $user = (new User())->create($user->name, $user->email, $user->document, $user->password);
        $this->repository->save($user);
    }
}