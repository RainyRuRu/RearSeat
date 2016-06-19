<?php


include __DIR__ . '/../vendor/autoload.php';

use RearSeat\UserSession;
use RearSeat\MessageModel;

session_start();

$id = $_POST['to'];
$message = $_POST['message'];
$user = UserSession::getUserId();

MessageModel::insertMessages($id, $user, $message);

header('Location: request.php?id=' . $id);