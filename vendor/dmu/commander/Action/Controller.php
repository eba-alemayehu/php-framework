<?php

namespace Commander\Action;

use Commander\Util\Color;
use Exception;

require 'Action.php'; 

class Controller extends Action {

    public $action = "make:controller"; 

    public function help(){
        return "make new contoller"; 
    }

    public function run(array $params){
        if(isset($params[0])){
            $file = APPLICATION_ROOT."/app/Http/Controllers/".$params[0]."Controller.php";
            $this->templet(__DIR__."/Templets/controller.php", $file, ["name" => $params[0]]); 

            echo Color::green("New $params[0] controller is created \r\n"); 
            echo Color::yellow('Controller: ').Color::green("app/Http/Controllers/".$params[0]."Controller.php". "\r\n"); 
            
        }else{
            Color::red("Controller name is not provided."); 
        }
    }
}