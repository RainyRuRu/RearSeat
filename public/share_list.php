<?php

include __DIR__ . '/../vendor/autoload.php';

use RearSeat\SeatModel;
use RearSeat\UserModel;
use RearSeat\UserSession;

session_start();

$loader = new Twig_Loader_Filesystem(__DIR__ . '/../views/');
$twig = new Twig_Environment($loader);

$result = SeatModel::searchSeatByRequest(1);

$data = [];

foreach ($result as $seat) {
    $user = UserModel::searchUser($seat['reporter']);
    $seat['photo'] = base64_encode($user['photo']);
    $seat['name'] = $user['name'];
    array_push($data, $seat);
}

$param = [
    "user" => [
        'id' => UserSession::getUserId(),
        'photo' => UserSession::getUserPhoto(),
    ],
    "data" => $data,
    "page" => "share"
];

echo $twig->render('list.html', $param);