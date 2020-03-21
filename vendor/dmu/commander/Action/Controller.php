<?php

namespace Commander\Action;

use Exception;

require 'Action.php'; 

class Controller extends Action {

    public $action = "make:controller"; 

    public function help(){
        return "make new contoller"; 
    }

    public function run(array $params){
        if(isset($params[0])){
            $this->templet(
                __DIR__."/Templets/controller.php", 
                APPLICATION_ROOT."/app/Http/Controllers/".$params[0]."Controller.php", 
                ["name" => $params[0]]); 
        }else{
            throw new Exception("Controller name is not supplied"); 
        }
    }
}