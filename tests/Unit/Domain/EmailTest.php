<?php


use App\Domain\Email;

test("Verifica se o email é inválido", function (){
    $email = new Email('dlemesdev@gmail');
})->throws(InvalidArgumentException::class);

test("Verifica se o email é válido", function (){
    $email = new Email('dlemesdev@gmail.com');
    expect((string) $email)->toBe('dlemesdev@gmail.com');
});