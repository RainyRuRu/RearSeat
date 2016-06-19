<?php
namespace RearSeat;

class Session
{
    public static function getUserId()
    {
        return Session::has('user_id') ? Session::get('songNum') : null;
    }

    public static function setUserId($id)
    {
        Session::put('user_id', $id);
    }

    public static function removeUserId()
    {
        Session::forget('user_id');
    }

    public static function getUserPhoto()
    {
        return Session::has('user_phto') ? Session::get('user_phto') : null;
    }
    
    public static function setUserPhoto($photo)
    {
        Session::put('user_phto', $photo);
    }

    public static function removeUserPhoto()
    {
        Session::forget('user_phto');
    }

    public static function removeAllUserSession()
    {
        static::removeUserId();
        static::removeUserPhoto();
    }
}