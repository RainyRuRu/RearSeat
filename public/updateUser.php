<?php
include __DIR__ . '/../vendor/autoload.php';

use RearSeat\SeatModel;
use RearSeat\UserModel;
use RearSeat\UserSession;

session_start();

$id = $_POST['id'];
$name = $_POST['name'];
$sex = $_POST['sex'];
$department = $_POST['department'];
$phone = $_POST['phone'];
$line = $_POST['line'];
$facebook = $_POST['facebook'];

$data = [
    'id' => $id,
    'name' => $name,
    'sex' => $sex,
    'department' => $department,
    'phone' => $phone,
    'line' => $line,
    'facebook' => $facebook,
];


UserModel::updateUser($data);

header('Location: profile.php');