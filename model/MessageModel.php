<?php
namespace RearSeat;

use RearSeat\DB;
use PDO;

class MessageModel
{
    public static function searchMessages($id)
    {
        $db = DB::connect();

        $sql = "select * from message join user on message.user_id = user.user_id Where seat_id = :seat_id";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(":seat_id", $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public static function insertMessages($id, $message, $user)
    {

    }
}