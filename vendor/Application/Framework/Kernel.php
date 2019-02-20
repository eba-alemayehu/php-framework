<?php

namespace Application\Framework;

use App\Http\Controllers;
use App\Commander\Middlewares;

session_start();
define("APPLICATION_ROOT", __DIR__."/../../../");
class Kernel{
    public function __construct(){
        $this->init();
        $this->run();
    }

    private function init(){
        $config = require_once (APPLICATION_ROOT."config/app.config.php");

        ini_set("display_errors", ($config['debug'])?1:0);
        ini_set("error_log", ($config['debug'])?1:0);
    }
    public function run(){
        $middelwares = [];
        foreach(Http\Router::middlewares() as $middelware){
            $m = "\\App\\Http\\Middlewares\\".$middelware;
            $m_obj = new $m();
            $m_obj->before();
            array_push($middelwares, $m_obj);
        }

        $controllerAttr = Http\Router::controller();
        $controller = "\\App\\Http\\Controllers\\".$controllerAttr[0];
        $method = $controllerAttr[1];

        $runable = new $controller;
        $response = null;
        $runable_method = $runable->$method();

        if(is_object($runable_method)){
            if(get_class($runable_method) == "Application\Framework\Support\View"){
                $response = $runable_method->show();
            }else{
                $response = json_encode($runable_method);
            }
        }else{
            $response = json_encode($runable_method);
        }

        foreach($middelwares as $middelware){
            $middelware->after($response);
        }
        echo $response;
    }
}