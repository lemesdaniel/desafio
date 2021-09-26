<?php
declare(strict_types=1);

return function (RoutingConfigurator $routes) {
    $routes->add('homepage', '/')
        ->controller([MainController::class, 'homepage'])
        ->stateless()
    ;
};