<?php
declare(strict_types=1);

use Challenge\Infrastructure\Http\User\UserController;
use Challenge\Infrastructure\Repositories\UserRepositorySqlite;
use PlugRoute\Http\Request;
use PlugRoute\Http\Response;

require '../vendor/autoload.php';
$db = new PDO("sqlite:../database/desafio.sqlite");
$db->setAttribute(PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION);
$route = \PlugRoute\RouteFactory::create();

$route->get('/', function (Response $response) {
    return $response->setStatusCode(200)
        ->json(['data' => 'Bem vindo ao desafio!!']);
});

$route->post('/user', function (Request $request, Response $response) use ($db) {
    try {
        (new UserController(new UserRepositorySqlite($db)))->store($request->all());
        return $response->setStatusCode(201)->json([]);
    } catch (Exception $exception) {
        return $response->setStatusCode(201)->json(['error_message' => $exception->getMessage()]);
    }
});


$route->on();