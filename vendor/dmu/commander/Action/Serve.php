<?php

namespace Commander\Action;

use Commander\Util\Color;

class Serve extends Action{
    public $action = "serve"; 

    public function help(){
        return "Starts a php server for aplication"; 
    }
    
    public function run($args)
    {
        $host = "localhost"; 
        $port = 8080; 

        for($i = $port; $i < 10000; $i++){
            $connection = @fsockopen($host, $port);
            if (!is_resource($connection))
            {
                echo Color::green("Application is serving at http://localhost:8080 \n"); 
                shell_exec('cd public && php -S localhost:8080'); 
                break; 
            }
            
        }
        
    }
}