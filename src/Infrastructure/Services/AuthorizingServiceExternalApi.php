<?php
declare(strict_types=1);

namespace App\Infrastructure\Services;

use App\Domain\Contracts\AuthorizingService;
use Symfony\Component\HttpClient\HttpClient;

class AuthorizingServiceExternalApi implements AuthorizingService
{

    /**
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     * @throws \Exception
     */
    public function execute(): bool
    {
        $httpClient = HttpClient::create();
        $response = $httpClient->request('GET', 'https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6');
        $content = $response->toArray();
        if ($content['message'] != "Autorizado") {
            throw new \Exception("Transação não autorizada pela operadora", 401);
        }
        return true;
    }
}