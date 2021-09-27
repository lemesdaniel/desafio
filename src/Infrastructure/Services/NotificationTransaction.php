<?php
declare(strict_types=1);

namespace App\Infrastructure\Services;

use App\Domain\Contracts\Notification;
use App\Domain\Contracts\User;

class NotificationTransaction implements Notification
{

    public function __construct(User $user)
    {
    }

    public function send(): bool
    {
        // TODO: Implement send() method.
        return true;
    }
}