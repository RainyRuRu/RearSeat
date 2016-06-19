<?php

include __DIR__ . '/../vendor/autoload.php';

use RearSeat\SeatModel;
use RearSeat\UserModel;
use RearSeat\UserSession;

session_start();

$loader = new Twig_Loader_Filesystem(__DIR__ . '/../views/');
$twig = new Twig_Environment($loader);

$tab = null;
$profile_id = UserSession::getUserId();

if (isset($_GET['tab'])) {
    $tab = $_GET['tab'];
}

if (isset($_GET['id'])) {
    $profile_id = $_GET['id'];
}

$param = [
    "tab" => $tab,
    "user" => [
        'id' => UserSession::getUserId(),
        'photo' => UserSession::getUserPhoto(),
    ],
];

echo $twig->render('profile.html', $param);