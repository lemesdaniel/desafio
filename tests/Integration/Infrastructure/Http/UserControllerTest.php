<?php

use Challenge\Infrastructure\Http\UserController;

test('Controller salvar usuário', function(){
     $repository = Mockery::mock(\Challenge\Domain\Contracts\UserRepository::class);
     $repository->shouldReceive('save')
        ->andReturnNull();

     $controller = new UserController($repository);


})->skip();