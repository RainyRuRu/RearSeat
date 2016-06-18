<?php

include __DIR__ . '/vendor/autoload.php';

use RearSeat\SeatModel;
use RearSeat\UserModel;
use RearSeat\DB;
use RearSeat\Mailer;

Mailer::mail();
/*
$image_data=file_get_contents('images.png');

$encoded_image=base64_encode($image_data);
var_dump($encoded_image);

$data = [
    'id' => 1,
    'phone' => '09111111111',
    'photo' => $image_data,
    'department' => 'test',
    'sex' => '女',
    'name' => '我'
];
UserModel::updateUser($data);

$data = UserModel::searchUser(1);

echo '<img src="data:image/png;base64,'. base64_encode($data[0]['photo']) .'" alt="Red dot" />';
*/

