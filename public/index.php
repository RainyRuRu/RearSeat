<?php
include __DIR__ . '/../vendor/autoload.php';

$loader = new Twig_Loader_Filesystem(__DIR__ . '/../views/');
$twig = new Twig_Environment($loader);

$param = [
	"user" => 'Linda'
];

echo $twig->render('test.twig.html', $param);