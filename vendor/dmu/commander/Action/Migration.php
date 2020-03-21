<?php

namespace Commander\Action; 

class Migration extends Action{
    public $action = "make:migration"; 

    public function help(){
        return "Create new migration"; 
    }
    
    public function run($params)
    {
        if(isset($params[0])){
           
            $this->templet(
                __DIR__."/Templets/migration.php", 
                APPLICATION_ROOT."/app/Database/Migrations/".$params[0]."Migration.php", 
                ["table" => $params[0]]); 
            $this->templet(
                __DIR__."/Templets/model.php", 
                APPLICATION_ROOT."/app/Models/".$params[0].".php", 
                ["model" => $params[0]]); 

        }else{
            throw new \Exception("module name and controller name is not supplied"); 
        }
    }
}