<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController
{
    /**
     * @Route("/")
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return new JsonResponse([
            'title' => 'Bem vindo ao desafio!!',
            'version' => 1,
        ]);
    }


}