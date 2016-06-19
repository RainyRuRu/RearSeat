<?php

include __DIR__ . '/../vendor/autoload.php';

use RearSeat\ScoreModel;
use RearSeat\UserModel;
use RearSeat\UserSession;
use RearSeat\SeatModel;
use RearSeat\ReservationModel;

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

$data = [];
if ($tab == 'request') {
    $data = showRequest($profile_id);

} else if ($tab == 'history') {

} else {
    $data = showProfile($profile_id);
}


$param = [
    "tab" => $tab,
    "user" => [
        'id' => UserSession::getUserId(),
        'photo' => UserSession::getUserPhoto(),
    ],
    "data" => $data,
];

echo $twig->render('profile.html', $param);


/////////////

function showProfile($profile_id) 
{
    $profile = UserModel::searchUser($profile_id);
    $good = ScoreModel::searchScores($profile_id, 2);
    $soso = ScoreModel::searchScores($profile_id, 1);
    $bad = ScoreModel::searchScores($profile_id, 0);

    $data = [
        "profile" => $profile,
        "score" => [
            "good" => $good,
            "soso" => $soso,
            "bad" => $bad,
        ],
    ];

    return $data;
}

function showRequest($profile_id)
{
    $post = SeatModel::searchSeatByReporter($profile_id);
    $reservation = ReservationModel::searchByUserId($profile_id);

    $data = [
        "request" => $post,
        "reservation" => $reservation,
    ];

    return $data;
}