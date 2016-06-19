<?php

namespace RearSeat;

use PHPMailer;

class Mailer
{

    public static function mail($address, $name, $code)
    {
        $mailInfoPath = __DIR__. '/../config.php';

        if (!is_file($mailInfoPath)) {
            echo '??';
            return;
        }

        $mailInfo = include($mailInfoPath);

        $mail = new PHPMailer;

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = $mailInfo['email'];            // SMTP username
        $mail->Password = $mailInfo['password'];                        // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->addAddress($address, $name);     // Add a recipient

        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'Welcome to join RearSeat';
        $mail->Body    = 'Hi, '. $name . '<br><br>'.
                        '<b>Welcome to join RearSeat</b> <br>'.
                        'Please click the url <br>'. 
                        '<a href= ' . $mailInfo['replyPath'] . 'mail='. $address . '&code='. $code . '> click this </a>'.
                        '<br>to complete your sign up!'.
                        '<br><br> Thank you!';

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
    }

}