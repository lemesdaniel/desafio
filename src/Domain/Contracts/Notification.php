<?php

declare(strict_types=1);


namespace App\Domain\Contracts;

interface Notification
{
    /**
     * @return bool
     */
    public function execute(array $user): bool;
}