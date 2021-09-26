<?php
declare(strict_types=1);

use Pecee\SimpleRouter\Router;
use Pecee\SimpleRouter\SimpleRouter;

require '../vendor/autoload.php';
$db = new PDO("sqlite:../database/desafio.sqlite");
$db->setAttribute(PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION);


SimpleRouter::get('/', function() {
    return Router::response()->json([
        'title' => 'Bem vindo ao desafio!!',
        'version' => 1,
    ]);
});


//$router->post('/user', function (ServerRequestInterface $request) use ($db): ResponseInterface {
//    $response = new Response;
//    try {
//        (new UserController(new UserRepositorySqlite($db)))->store($request->all());
//        $response->getBody()->write(json_encode(['message'=>'success']));
//        return $response->withAddedHeader('content-type', 'application/json')->withStatus(201);
//
//    } catch (Exception $exception) {
//        $response->getBody()->write(json_encode(['message'=>$exception->getMessage()]));
//        return $response->withAddedHeader('content-type', 'application/json')->withStatus(400);
//
//    }
//});
//

SimpleRouter::start();
