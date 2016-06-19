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

    public static function searchScorePost($seat_id, $poster_id)
    {
        $db = DB::connect();

        $sql = "select * from score Where seat_id = :seat_id and poster_id = :poster_id";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(":seat_id", $seat_id);
        $stmt->bindParam(":poster_id", $poster_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public static function searchScoreReceive($seat_id, $receiver_id)
    {
        $db = DB::connect();

        $sql = "select * from score Where seat_id = :seat_id and receiver_id = :receiver_id";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(":receiver_id", $receiver_id);
        $stmt->bindParam(":seat_id", $seat_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public static function insertScores()
    {

    }
}