<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use DomainException;
use Throwable;

class TransactionException extends DomainException
{

    /**
     * @param string|null $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = "Ocorreu um erro", int $code = 422, Throwable $previous = null){
        parent::__construct($message, $code, $previous);

    }
}