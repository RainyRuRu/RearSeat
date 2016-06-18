<?php
include __DIR__ . '/../vendor/autoload.php';

$loader = new Twig_Loader_Filesystem(__DIR__ . '/../views/');
$twig = new Twig_Environment($loader);

$param = [
	"user_id" => '1234'
];

echo $twig->render('index.html', $param);