<?php

namespace Commander\Action; 

class Serve extends Action{
    public $action = "serve"; 

    public function help(){
        return "Starts a php server for aplication"; 
    }
    
    public function run($args)
    {
        echo "php is serving at http://localhost:8080 \n"; 
        shell_exec('cd public && php -S localhost:8080'); 
    }
}