<?php

include __DIR__ . '/../vendor/autoload.php';

use RearSeat\UserModel;

$action = $_GET['action'];

if (function_exists("api_{$action}")) {
    $func = "api_{$action}";
    $result = $func();
} else {
    $result = [];
}

echo json_encode($result, JSON_FORCE_OBJECT);

exit;

/////////////////////////////////////////////////////////

function api_hasEmail() {
    $email = $_GET['email'];
    $result = UserModel::searchUserByEmail($email);
    
    $check = true;

    if (empty($result)) {
        $check = false;
    }

    return ['has' => $check];
}