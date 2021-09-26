<?php
declare(strict_types=1);


namespace App\Domain\Contracts;

interface Notification
{
    /**
     * @param User $user
     */
    public function __construct(User $user);

    /**
     * @return bool
     */
    public function send():bool;
}