<?php
namespace RearSeat;

use RearSeat\DB;
use PDO;

class ScoreModel
{
    public static function searchScores($receiver_id, $type)
    {
        $db = DB::connect();

        $sql = "select * from score Where receiver_id = :receiver_id and score = :type";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(":receiver_id", $receiver_id);
        $stmt->bindParam(":type", $type);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public static function insertScores()
    {

    }
}