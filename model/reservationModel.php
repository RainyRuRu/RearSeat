<?php
namespace RearSeat;

use RearSeat\DB;
use PDO;

class ReservationModel
{
    public static function searchByUserId($id) {
        $db = DB::connect();

        $sql = "select * from reservation Where user_id = :user_id order by time asc";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(":user_id", $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}