<?php

use Challenge\Infrastructure\HashPassword;

test('Verifica se as senhas combinam', function(){
    $password = new HashPassword();
    $hash = $password->make('123456789');
    $isValid = $password->check('123456789', $hash);
    expect($isValid)->toBeTrue();
});

test('Verifica se as senhas são diferentes', function(){
    $password = new HashPassword();
    $hash = $password->make('123456789');
    $isValid = $password->check('abcdef', $hash);
    expect($isValid)->toBeFalse();
});