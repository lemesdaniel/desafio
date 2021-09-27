<?php
declare(strict_types=1);

namespace App\Infrastructure\Services;

use App\Domain\Contracts\Notification;
use App\Domain\Contracts\User;
use Exception;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class NotificationTransaction implements Notification
{

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function execute(array $user): bool
    {
        $httpClient = HttpClient::create();
        $response = $httpClient->request('GET', 'http://o4d9z.mocklab.io/notify');
        $content = $response->toArray();
        if ($content['message'] != "Success") {
            throw new Exception("Notificação falhou, transação não efetuada", 401);
        }
        return true;
    }
}