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

    public static function seatchDoneSeatByReporter($reporter)
    {
        $db = DB::connect();

        $sql = "select * from seat Where reporter = :reporter and status = 2 order by post_time asc";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(":reporter", $reporter);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public static function searchDoneSeatByOwner($owner)
    {
        $db = DB::connect();

        $sql = "select * from seat Where owner_id = :owner and status = 2 order by post_time asc";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(":owner", $owner);
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
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
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

    public static function insertSeat($data) {
        $db = DB::connect();

        $sql = "Insert into seat(reporter, request, starting_point, end_point, go_time, reward, status, description)".
            "value(:reporter, :request, :starting_point, :end_point, :go_time, :reward, :status, :description)";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(":reporter", $data['reporter']);
        $stmt->bindParam(":request", $data['request']);
        $stmt->bindParam(":starting_point", $data['starting_point']);
        $stmt->bindParam(":end_point", $data['end_point']);
        $stmt->bindParam(":go_time", $data['go_time']);
        $stmt->bindParam(":reward", $data['reward']);
        $stmt->bindParam(":status", 0);
        $stmt->bindParam(":description", $data['description']);

        $stmt->execute();
    }
    
}