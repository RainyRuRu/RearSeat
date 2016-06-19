<?php
namespace RearSeat;

use RearSeat\DB;
use PDO;

class SeatModel{

    public static $limit = 10;

    public static function searchSeatByRequest($request, $page = null) {
        $db = DB::connect();

        $sql = "select * from seat Where request = :request order by post_time asc";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(":request", $request);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = static::splitData($result, $page);

        return $result;
    }

    public static function searchSeatByReporter($reporter) {
        $db = DB::connect();

        $sql = "select * from seat Where reporter = :reporter order by post_time asc";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(":reporter", $reporter);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public static function searchSeatById($id) {
        $db = DB::connect();

        $sql = "select * from seat Where seat_id = :seat_id order by post_time asc";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(":seat_id", $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }

    public static function searchSeatByKeyword($request, $keyword, $page = null) {
        $db = DB::connect();
        $keyword = '%' . $keyword . '%';
        $sql = "select * from seat Where request = :request and starting_point LIKE :keyword or end_point LIKE :keyword order by post_time asc";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(":request", $request);
        $stmt->bindParam(":keyword", $keyword);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $result = static::splitData($result, $page);

        return $result;
    }

    private static function splitData($data, $page) {
        $new_data = [];

        for ($i = $page * static::$limit; $i < count($data); $i++) {
            array_push($new_data, $data[$i]);
        }

        return $new_data;
    }

}