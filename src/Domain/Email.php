<?php

declare(strict_types=1);

namespace App\Domain;

use Psr\Log\InvalidArgumentException;

class Email
{
    private string $email;

    public function __construct(string $email)
    {
        $this->setEmail($email);
    }

    private function setEmail($email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Email {$email} inserido não é válido");
        }
        $this->email = $email;
    }

    public function __toString(): string
    {
        return $this->email;
    }

}