<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\ErrorHandler\Exception\FlattenException;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;

class ErrorController extends BaseController
{
    public function show(FlattenException $exception, DebugLoggerInterface $logger = null): \Symfony\Component\HttpFoundation\JsonResponse
    {
        return $this->json([
            "code" => $exception->getCode(),
            "message" => $exception->getMessage()
        ]);
    }
}