<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/15/19
 * Time: 11:59 PM
 */

namespace Commander\Action;

use Commander\Util\Color;

class Middeleware extends Action
{
    public $action = "make:middelware"; 

    public function help(){
        return "Create middleware"; 
    }
    public function run($params)
    {
        if(isset($params[0])){
            $file = APPLICATION_ROOT."/app/Http/Middlewares/".$params[0].".php";
            $this->templet(__DIR__."/Templets/middeleware.php", $file, ["name" => $params[0]]); 

            echo Color::green("New $params[0] Middeleware is created \r\n"); 
            echo Color::yellow('Middelware: ').Color::green("app/Http/Middlewares/".$params[0].".php". "\r\n"); 
        }else{
            Color::red("Controller name is not supplied"); 
        }
    }
}