<?php

include __DIR__ . '/../vendor/autoload.php';

use RearSeat\SeatModel;
use RearSeat\UserModel;
use RearSeat\UserSession;

session_start();

UserSession::removeAllUserSession();

header('Location: index.php');