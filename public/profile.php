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
    $data = showHistory($profile_id);

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

function showHistory($profile_id)
{
    $request_tmp = SeatModel::seatchDoneSeatByReporter($profile_id);
    $reservation_tmp = SeatModel::searchDoneSeatByOwner($profile_id); 


    $request = [];
    $reservation = [];

    foreach ($request_tmp as $seat) {
        $score = [];
        $score['post'] = ScoreModel::searchScorePost($seat['seat_id'], $seat['reporter'])['score'];
        $score['receive'] = ScoreModel::searchScoreReceive($seat['seat_id'], $seat['reporter'])['score'];
        $seat = array_merge($seat, ['score' => $score]);
        array_push($request, $seat);
    }

    foreach ($reservation_tmp as $seat) {
        $score = [];
        $score['post'] = ScoreModel::searchScorePost($seat['seat_id'], $seat['reporter']);
        $score['receive'] = ScoreModel::searchScoreReceive($seat['seat_id'], $seat['reporter']);
        array_push($seat, ['score' => $score]);
        array_push($reservation, $seat);
    }

    $data = [
        "request" => $request,
        "reservation" => $reservation,
    ];

    return $data;
}