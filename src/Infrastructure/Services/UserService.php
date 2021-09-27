<?php
declare(strict_types=1);

namespace App\Infrastructure\Services;

use App\Application\User\StoreUser;
use App\Application\User\UserDto;
use App\Domain\Contracts\UserRepository;
use App\Infrastructure\HashPassword;

class UserService
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
     * @param $data
     * @return array
     */
    public function execute($data): array
    {
        $document = $data->document ?? '';
        $name = $data->name ?? '';
        $email = $data->email ?? '';
        $password = $this->hashPassword($data->password);
        $user = new UserDto($document, $name, $email, $password);
        return (new StoreUser($this->repository))->execute($user);
    }

    /**
     * @param $password
     * @return string
     */
    public function hashPassword($password): string
    {
        return (new HashPassword())->make($password);
    }


}