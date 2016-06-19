<?php
namespace RearSeat;

use RearSeat\DB;
use PDO;

class ReservationModel
{
    public static function searchByUserId($id) {
        $db = DB::connect();

        $sql = "select * from reservation JOIN seat Where user_id = :user_id order by time asc";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(":user_id", $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public static function add($seat_id, $user_id, $message) {
        $db = DB::connect();
        $sql = "Insert into reservation(seat_id, user_id, message)".
            "value(:seat_id, :user_id, :message)";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(":seat_id", $seat_id);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":message", $message);

        $stmt->execute();
    }
}