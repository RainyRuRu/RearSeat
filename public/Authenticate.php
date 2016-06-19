<?php

include __DIR__ . '/../vendor/autoload.php';

use RearSeat\UserModel;
use RearSeat\UserSession;

session_start();

$loader = new Twig_Loader_Filesystem(__DIR__ . '/../views/');
$twig = new Twig_Environment($loader);

$email = $_GET['mail'];
$code = $_GET['code'];

$result = UserModel::authenticate($email, $code);

if ($result) {
    UserSession::setMessage("認證成功");
}

header('Location: index.php');
