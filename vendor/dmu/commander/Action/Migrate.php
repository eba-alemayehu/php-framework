<?php

namespace Commander\Action; 

class Migrate extends Action{
    public $action = "make:migration"; 

    public function help(){
        return "Create new migration"; 
    }
    
    public function run($args)
    {
        if(isset($args[0])){
            $namespace = "\\App\\Database\\Migrations\\";
            $class = $args[0];
            $obj = $namespace."".$class;

            $mig = new $obj();
            $mig->up();
            $mig->create();
        }else{

            $migrations = scandir(APPLICATION_ROOT . "/app/Database/Migrations/");
            foreach ($migrations as $migration) {

                if ($migration != "." && $migration != "..") {

                    $namespace = "\\App\\Database\\Migrations\\";
                    $class = explode(".", $migration)[0];
                    $obj = $namespace."".$class;

                    $mig = new $obj();
                    $mig->up();
                    $mig->create();
                }
            }
        }
        
    }
}