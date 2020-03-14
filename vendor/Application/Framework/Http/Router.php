<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/15/19
 * Time: 10:59 PM
 */

namespace Application\Framework\Http;

use Application\Framework\Foundation\Request;

class Router
{
    public function __construct()
    {
    }

    private static function loadRouter(){
       $router = require(APPLICATION_ROOT."routes/router.php");
        return $router;
    }

    public static function url(){
        if(isset($_GET['url'])){
            return $_GET["url"];
        }else{
            return (isset($_SERVER['PATH_INFO'])?$_SERVER['PATH_INFO']:""); 
        }
    }

    public static function params(){
        $method = Request::getMethod();
        if(isset(self::loadRouter()[$method][self::url()])){
            return self::loadRouter()[$method][self::url()];
        }else{
            http_response_code(404);
            require_once (APPLICATION_ROOT."app/Resource/views/error/404.php");
            die();
        }
    }

    public static function controller(){
        return explode("@",self::params()["controller"]);
    }

    public static function middlewares(){
        return self::params()["middleware"];
    }
}