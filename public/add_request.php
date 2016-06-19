<?php

include __DIR__ . '/../vendor/autoload.php';

use RearSeat\SeatModel;
use RearSeat\UserModel;
use RearSeat\UserSession;

session_start();

$loader = new Twig_Loader_Filesystem(__DIR__ . '/../views/');
$twig = new Twig_Environment($loader);

$user_id = UserSession::getUserId();
$request = $_POST['request'];
$starting_point = $_POST['starting_point'];
$end_point = $_POST['end_point'];
$go_time = $_POST['go_time'];
$reward = $_POST['reward'];
$description = $_POST['description'];
        
$data = [
    'user_id' = $user_id,
    'request' = $request,
    'starting_point' = $starting_point,
    'end_point' = $end_point;
    'go_time' = $go_time;
    'reward' = $reward;
    'description' = $description;
];

SeatModel::insertSeat($data);

UserSession::setMessage("新增成功");
header('Location: index.php');