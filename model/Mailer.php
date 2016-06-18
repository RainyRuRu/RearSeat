<?php

namespace RearSeat;

use PHPMailer;

class Mailer
{

public static function mail()
{

    $to      = 'believeu123@yahooo.com.tw';
$subject = 'the subject';
$message = 'hello';
$headers = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

echo mail($to, $subject, $message, $headers);


}

}