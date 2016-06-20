<?php
include __DIR__ . '/../vendor/autoload.php';

use RearSeat\SeatModel;
use RearSeat\UserModel;
use RearSeat\UserSession;

session_start();

$loader = new Twig_Loader_Filesystem(__DIR__ . '/../views/');
$twig = new Twig_Environment($loader);

$findSeat = SeatModel::searchSeatByRequest(0, 0);
$shareSeats = SeatModel::searchSeatByRequest(1, 0);

$finds = [];
$shares = [];

$count = 0;
foreach ($findSeat as $seat) {
    if ($count == 5) {
        break;
    }
    $user = UserModel::searchUser($seat['reporter']);
    $seat['photo'] = base64_encode($user['photo']);
    array_push($finds, $seat);
    $count++;
}

$count = 0;
foreach ($shareSeats as $seat) {
    if ($count == 5) {
        break;
    }
    $user = UserModel::searchUser($seat['reporter']);
    $seat['photo'] = base64_encode($user['photo']);
    array_push($shares, $seat);
    $count++;
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