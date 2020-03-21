<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/18/19
 * Time: 6:55 PM
 */

namespace Application\Support;


class Response
{
    public static function redirect($url){
        header("location: ". substr($_SERVER['SCRIPT_NAME'], 0, -9).$url);
    }
}