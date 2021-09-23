<?php
require '../vendor/autoload.php';

$f3 = \Base::instance();
$f3->set('DB', new DB\SQL('sqlite:../database/desafio.sqlite'));

$f3->route('GET /',
    function() {
        echo 'Hello, world!';
    }
);
$f3->run();