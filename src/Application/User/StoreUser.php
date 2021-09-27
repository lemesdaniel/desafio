<?php
declare(strict_types=1);

namespace App\Application\User;

use App\Domain\Contracts\UserRepository;
use App\Domain\Entities\User;

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
     * @param UserDto $userDto
     * @return array
     */
    public function execute(UserDto $userDto): array
    {
        $user = (new User())->create($userDto->name, $userDto->email, $userDto->document, $userDto->password);
        return  $this->repository->save($user);
    }

    /**
     * @param UserDto $user
     * @return array
     */
    public function load(UserDto $user): array
    {
        $userDto = (new User())->load($user->id, $user->name, $user->email, $user->document);
        return  $this->repository->save($userDto);
    }
}