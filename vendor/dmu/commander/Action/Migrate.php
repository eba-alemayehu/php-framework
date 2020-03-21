<?php

namespace Commander\Action;

use Commander\Util\Color;
use Exception;

class Migrate extends Action{
    public $action = "migrate"; 

    public function help(){
        return "Create new migration"; 
    }
    
    private function migrate($class){
        try{
            $namespace = "\\App\\Database\\Migrations\\";
            $obj = $namespace."".$class;

            $mig = new $obj();
            $mig->up();
            $table = $mig->create();
            echo Color::orange("\t $table").Color::green(" table is created. \r\n");
        }catch(Exception $e){
            echo Color::red("Migration faild! \r\n"); 
            echo Color::red($e->getMessage()); 
        }
         
    }
    public function run($args)
    {
        echo Color::yellow("Migration started. \n"); 
        if(isset($args[0])){
            $this->migrate($args[0]);
        }else{

            $migrations = scandir(APPLICATION_ROOT . "/app/Database/Migrations/");
            foreach ($migrations as $migration) {
                if ($migration != "." && $migration != "..") {
                    $this->migrate(explode(".", $migration)[0]);
                }
            }
        }
        echo Color::yellow("Migration finished. \n");  
    }
}