<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/15/19
 * Time: 11:59 PM
 */

namespace Commander\Action;


class Middeleware extends Action
{
    public $action = "make:middelware"; 

    public function help(){
        return "Create middleware"; 
    }
    public function run($params)
    {
        if(isset($params[0])){
            $this->templet(
                __DIR__."/Templets/middeleware.php", 
                APPLICATION_ROOT."/app/Http/Middlewares/".$params[0].".php", 
                ["name" => $params[0]]); 
        }else{
            throw new \Exception("Controller name is not supplied"); 
        }
    }
}