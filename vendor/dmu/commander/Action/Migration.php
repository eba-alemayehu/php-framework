<?php

namespace Commander\Action;

use Commander\Util\Color;

class Migration extends Action{
    public $action = "make:migration"; 

    public function help(){
        return "Create new migration and model"; 
    }
    
    public function run($params)
    {
        if(isset($params[0])){
            $migratoinFile = APPLICATION_ROOT."/app/Database/Migrations/".$params[0]."Migration.php";
            $this->templet(__DIR__."/Templets/migration.php", $migratoinFile, ["table" => $params[0]]);

            echo Color::green("New $params[0] controller is created \r\n"); 
            echo Color::yellow('Controller: ').Color::green("app/Database/Migrations/".$params[0]."Migration.php". "\r\n"); 

            if(!isset($params[1]) && $params[1] != '--no-model'){
                echo "\r\n"; 
                $modelFile = APPLICATION_ROOT."/app/Models/".$params[0].".php";
                $this->templet(__DIR__."/Templets/model.php", "app/Database/Migrations/".$params[0]."Migration.php", ["model" => $params[0]]); 

                echo Color::green("New $params[0] controller is created \r\n"); 
                echo Color::yellow('Controller: ').Color::green("app/Database/Migrations/".$params[0]."Migration.php". "\r\n"); 
            }
           
        }else{
            Color::red("Module name and controller name is not supplied"); 
        }
    }
}