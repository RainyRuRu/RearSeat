<?php
namespace RearSeat;

class UserSession
{

    public static function getUserId()
    {
        return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    }

    public static function setUserId($id)
    {
        $_SESSION['user_id'] = $id;
    }

    public static function removeUserId()
    {
        unset($_SESSION['user_id']);
    }

    public static function getUserPhoto()
    {
        return isset($_SESSION['user_photo']) ? $_SESSION['user_photo'] : null;
    }

    public static function setUserPhoto($photo)
    {
        $_SESSION['user_photo'] = $photo;
    }

    public static function removeUserPhoto()
    {
        unset($_SESSION['user_photo']);
    }

    public static function removeAllUserSession()
    {
        static::removeUserId();
        static::removeUserPhoto();
    }
}