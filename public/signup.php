<?php

include __DIR__ . '/../vendor/autoload.php';

use RearSeat\SeatModel;
use RearSeat\UserModel;
use RearSeat\UserSession;

session_start();

$email = $_POST['email'];
$password = $_POST['password'];
$name = $_POST['name'];
$sex = $_POST['sex'];
$department = $_POST['department'];
$phone = $_POST['phone'];

$data = [
    'email' => $email,
    'password' => $password,
    'name' => $name,
    'sex' => $sex,
    'dapartment' => $department,
    'phone' => $phone
];

$result = UserModel::createUser($data);

if ($result) {
    UserSession::setMessage("請至信箱認證！");
    header('Location: index.php');
} else {
    UserSession::setMessage("註冊失敗");
    header('Location: index.php');
}
