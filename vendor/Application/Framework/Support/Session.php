<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/18/19
 * Time: 6:43 PM
 */

namespace Application\Framework\Support;


class Session
{
    public function __construct()
    {
    }

    public static function set($key, $val){
        $_SESSION[$key] = $val;
    }

    public static  function get($key){
        return isset($_SESSION[$key])?$_SESSION[$key]: null;
    }

    public static function exist($key){
        return (isset($_SESSION[$key]));
    }

}