<?php

include __DIR__ . '/../vendor/autoload.php';

use RearSeat\UserModel;

$loader = new Twig_Loader_Filesystem(__DIR__ . '/../views/');
$twig = new Twig_Environment($loader);

$email = $_GET['mail'];
$code = $_GET['code'];

$result = UserModel::authenticate($email, $code);

if ($result) {
    //echo $twig->render('test.twig.html', $param);
} else {
    
}
