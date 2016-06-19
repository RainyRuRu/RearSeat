<?php

include __DIR__ . '/../vendor/autoload.php';

use RearSeat\SeatModel;
use RearSeat\UserModel;
use RearSeat\UserSession;

session_start();

$loader = new Twig_Loader_Filesystem(__DIR__ . '/../views/');
$twig = new Twig_Environment($loader);

$param = [
    "user" => [
        'id' => UserSession::getUserId(),
        'photo' => UserSession::getUserPhoto(),
    ],
    "page" => "find",
    "data" => [
        ['id' => 123,
        'poster' => "me",
        'poster_photo' => "iVBORw0KGgoAAAANSUhEUgAAAAUA
AAAFCAYAAACNbyblAAAAHElEQVQI12P4//8/w38GIAXDIBKE0DHxgljNBAAO
9TXL0Y4OHwAAAABJRU5ErkJggg==",
        'go_time' => "2016/06/19 10:00:00",
        'starting_point' => "A",
        'end_point' => "B",
        'reward' => "麥香紅茶",
        'description' => "希望路上能聊聊天"
        ],['id' => 456,
        'poster' => "CACA",
        'poster_photo' => "iVBORw0KGgoAAAANSUhEUgAAAAUA
AAAFCAYAAACNbyblAAAAHElEQVQI12P4//8/w38GIAXDIBKE0DHxgljNBAAO
9TXL0Y4OHwAAAABJRU5ErkJggg==",
        'go_time' => "2016/06/19 10:00:00",
        'starting_point' => "A",
        'end_point' => "B",
        'reward' => "麥香奶茶",
        'description' => "自備安全帽"
        ]
    ]
];

echo $twig->render('list.html', $param);