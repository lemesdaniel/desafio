<?php
use App\Domain\Document;

test("Verifica se o CPF/CNPJ é válido", function($cpf){
    $document = new Document($cpf);
    expect($document->validDocument())->toBeTrue();
})->with([
    ['137.772.466-20'],
    ['67.391.387/0001-25'],
    ['67391387000125'],
    ['13777246620']
]);


test("Verifica se o CPF/CNPJ é Inválido", function($document){
    new Document($document);
})->with([
    ['999.999.999.99'],
    ['99999999999'],
    ['137.772.466-21'],
    ['67.391.387/0001-22'],
    ['99.999.999/9999-99'],
    ['67391387000122'],
    ['13777246621']
])->expectException(InvalidArgumentException::class);
