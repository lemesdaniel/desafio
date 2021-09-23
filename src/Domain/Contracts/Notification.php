<?php
declare(strict_types=1);


namespace Challenge\Domain\Contracts;

interface Notification
{
    public function __construct(User $user);
    public function send():bool;
}