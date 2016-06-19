<?php

include __DIR__ . '/../vendor/autoload.php';

use RearSeat\UserModel;

$loader = new Twig_Loader_Filesystem(__DIR__ . '/../views/');
$twig = new Twig_Environment($loader);

$email = $_GET['mail'];
$code = $_GET['code'];

UserModel::authenticate($email, $code);

var_dump($email);
var_dump($code);
var_dump('hi');

//echo $twig->render('test.twig.html', $param);