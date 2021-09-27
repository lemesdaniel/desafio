<?php
declare(strict_types=1);

namespace App\Serializer;

use Symfony\Component\ErrorHandler\Exception\FlattenException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class CustomErrorNormalizer implements NormalizerInterface
{
    public function normalize($exception, string $format = null, array $context = []): array
    {
        return [
            'content' => 'An error.',
            'exception'=> [
                'message' => $exception->getMessage(),
                'code' => $exception->getStatusCode(),
            ],
        ];
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof FlattenException;
    }
}