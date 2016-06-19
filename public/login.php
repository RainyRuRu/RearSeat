<?php
include __DIR__ . '/../vendor/autoload.php';

use RearSeat\SeatModel;
use RearSeat\UserModel;
use RearSeat\UserSession;

session_start();

$loader = new Twig_Loader_Filesystem(__DIR__ . '/../views/');
$twig = new Twig_Environment($loader);

$email = $_POST['email'];
$password = $_POST['password'];

UserModel::login($email, $password);

header('Location: index.php');