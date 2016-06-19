<?php

include __DIR__ . '/../vendor/autoload.php';

use RearSeat\SeatModel;
use RearSeat\ScoreModel;
use RearSeat\UserModel;
use RearSeat\UserSession;
use RearSeat\MessageModel;

session_start();

$loader = new Twig_Loader_Filesystem(__DIR__ . '/../views/');
$twig = new Twig_Environment($loader);

$id = $_GET['id'];

$seat = SeatModel::searchSeatById($id);
$userProfile = UserModel::searchUser($seat['reporter']);
$userProfile['photo'] = base64_encode($userProfile['photo']);

$messages = MessageModel::searchMessages($id);
$good = ScoreModel::searchScores($userProfile['user_id'], 2);
$soso = ScoreModel::searchScores($userProfile['user_id'], 1);
$bad = ScoreModel::searchScores($userProfile['user_id'], 0);


$data = [
    "profile" => $userProfile,
    "score" => [
        "good" => $good,
        "soso" => $soso,
        "bad" => $bad,
    ],
    "seat" => $seat,
    "message" => $messages
];

$param = [
    "user" => [
        'id' => UserSession::getUserId(),
        'photo' => UserSession::getUserPhoto(),
    ],
    "data" => $data,
    "request" => $seat['request']
];

echo $twig->render('request.html', $param);