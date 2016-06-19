<?php
namespace RearSeat;

use PDO;

class DB
{
    private static $db_path = "192.168.2.105";
    private static $user_name = "user";
    private static $user_password ="12345678";
    private static $database = "rear_seat";

    public static function connect()
    {
        $db = new PDO(
            'mysql:host=' . static::$db_path . ';dbname=' . static::$database,
            static::$user_name,
            static::$user_password,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

        return $db;
    }
}