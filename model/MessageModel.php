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

    public static function insertMessages($id, $user_id, $message)
    {
        $db = DB::connect();
        $sql = "Insert into message(seat_id, user_id, message)".
            "value(:seat_id, :user_id, :message)";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(":seat_id", $id);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":message", $message);

        $stmt->execute();
    }
}