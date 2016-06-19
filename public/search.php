<?php

include __DIR__ . '/../vendor/autoload.php';

use RearSeat\SeatModel;
use RearSeat\UserModel;
use RearSeat\UserSession;

session_start();

$loader = new Twig_Loader_Filesystem(__DIR__ . '/../views/');
$twig = new Twig_Environment($loader);

$request = $_GET['request'];
$keyword = $_GET['keyword'];

$result = SeatModel::searchSeatByKeyword($request, $keyword, 0);

$data = [];

foreach ($result as $seat) {
    $user = UserModel::searchUser($seat['reporter']);
    $seat['photo'] = $user['photo'];
    array_push($data, $seat);
}

$param = [
    "user" => [
        'id' => UserSession::getUserId(),
        'photo' => UserSession::getUserPhoto(),
    ],
    "data" => $data,
];

echo $twig->render('list.html', $param);