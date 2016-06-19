<?php

namespace RearSeat;

use RearSeat\DB;
use RearSeat\Mailer;
use RearSeat\UserSession;
use PDO;

class UserModel
{
    public static function createUser($data)
    {
        $db = DB::connect();
        $password_hash = password_hash($data['password'], PASSWORD_DEFAULT);
        $code = static::createHushCode();

        $sql = "Insert into user(email, password, phone, photo, department, sex, name, code)".
            "value(:email, :password, :phone, :photo, :department, :sex, :name, :code)";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(":email", $data['email']);
        $stmt->bindParam(":password", $password_hash);
        $stmt->bindParam(":phone", $data['phone']);
        $stmt->bindParam(":photo", $data['photo']);
        $stmt->bindParam(":department", $data['department']);
        $stmt->bindParam(":sex", $data['sex']);
        $stmt->bindParam(":name", $data['name']);
        $stmt->bindParam(":code", $code);

        $stmt->execute();

        Mailer::mail($data['email'], $data['name'], $code);
    }

    public static function login($email, $password)
    {
        $db = DB::connect();

        $stmt = $db->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $row = $stmt->fetch();

        if ($row == null) {
            return false;
        } else {
            if (password_verify($password, $row['password'])) {
                UserSession::setUserId($row['user_id']);
                UserSession::setUserPhoto($row['photo']);
                return ture;
            }
        }

        return false;
    }

    public static function updateUser($data)
    {
        $db = DB::connect();

        $sql = "update user set phone = :phone, photo = :photo, department = :department, sex = :sex, name = :name " .
            "WHERE user_id = :id";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(":id", $data['id']);
        $stmt->bindParam(":phone", $data['phone']);
        $stmt->bindParam(":photo", $data['photo']);
        $stmt->bindParam(":department", $data['department']);
        $stmt->bindParam(":sex", $data['sex']);
        $stmt->bindParam(":name", $data['name']);

        $stmt->execute();
    }

    public static function changePassword($data)
    {
        $db = DB::connect();

        $password_hash = password_hash($data['password'], PASSWORD_DEFAULT);

        $sql = "update user set password = :password " .
            "WHERE user_id = :id";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(":id", $data['id']);
        $stmt->bindParam(":password", $password_hash);
        

        $stmt->execute();
    }

    public static function searchUser($id)
    {
        $db = DB::connect();

        $sql = "select * from user Where user_id = :id";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    private static function createHushCode()
    {
        $nameLen = 20;
        $patten = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $pattenLen = strlen($patten);

        $code = "";

        for ($i = 0; $i < $nameLen; $i++) {
            $code .= $patten[rand(0, $pattenLen - 1)];
        }
        return $code;
    }

    public static function authenticate($mail, $code)
    {
        $db = DB::connect();

        $sql = "select * from user Where email = :email";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(":email", $mail);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['code'] == $code) {
            static::authenticatDone($result['user_id']);
            return ture;
        }

        return false;
    }

    private static function authenticatDone($id)
    {
        $db = DB::connect();

        $sql = "update user set code = true WHERE user_id = :id";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(":id", $id);

        $stmt->execute();
    }
}