<?php
include __DIR__ . '/../vendor/autoload.php';

use RearSeat\SeatModel;
use RearSeat\UserModel;
use RearSeat\UserSession;

session_start();

$loader = new Twig_Loader_Filesystem(__DIR__ . '/../views/');
$twig = new Twig_Environment($loader);

$findSeat = SeatModel::searchSeatByRequest(0, 5);
$shareSeats = SeatModel::searchSeatByRequest(1, 5);

$finds = [];
$shares = [];

foreach ($findSeat as $seat) {
    $user = UserModel::searchUser($seat['reporter']);
    $seat['photo'] = $user['photo'];
    array_push($finds, $seat);
}

foreach ($shareSeats as $seat) {
    $user = UserModel::searchUser($seat['reporter']);
    $seat['photo'] = $user['photo'];
    array_push($finds, $seat);
}

$message = null;

if (!is_null(UserSession::getMessage())) {
    $message = UserSession::getMessage();
    UserSession::removeMessage();
}

$param = [
	"user" => [
        'id' => UserSession::getUserId(),
        'photo' => UserSession::getUserPhoto(),
    ],
    "find" => $finds,
    "share" => $shares,
    "message" => $message,
];

echo $twig->render('index.html', $param);