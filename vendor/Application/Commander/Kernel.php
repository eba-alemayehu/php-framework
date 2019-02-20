<?php
namespace Application\Commander; 

define("APPLICATION_ROOT", __DIR__."/../../../");

class Kernel{

    private $arguments; 
    private $message; 

    public function __construct($_args){
        $this->arguments = $_args; 

        if(!isset($_args[1])){
            $this->message ="No action is spacified\n"; 
            return; 
        }
        switch($_args[1]) {
            case 'make':
                $this->make();
                break;
            case 'migrate':
                if(isset($_args[2])){
                    $namespace = "\\App\\Database\\Migrations\\";
                    $class = $_args[2];
                    $obj = $namespace."".$class;

                    $mig = new $obj();
                    $mig->up();
                    $mig->create();
                }
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
                break;
        }
    }

    private function make(){
        if(!isset($this->arguments[2])){
            $this->message ="Name wes not provided";
            return; 
        }
        switch($this->arguments[2]){
            case 'module':  
                $module = new Action\Module($this->arguments); 
            break; 
            case 'controller': 
                $controller = new Action\Controller($this->arguments); 
            break;
            case 'middeleware':
                $controller = new Action\Middeleware($this->arguments);
                break;
            case 'migration':
                echo "migrate";
                $migraion = new Action\Migration($this->arguments);
                break;
        }
       
    }

    private function migrate(){

    }

    public function terminate(){
        return $this->message; 
    }
}
?>