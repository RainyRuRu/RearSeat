<?php
namespace RearSeat;

use RearSeat\DB;
use PDO;

class SeatModel{

    public static function searchSeatByRequest($request) {
        $db = DB::connect();

        $sql = "select * from seat Where request = :request order by post_time asc";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(":request", $request);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

}