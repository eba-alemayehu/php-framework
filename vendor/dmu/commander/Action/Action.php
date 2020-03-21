<?php 

namespace Commander\Action; 

abstract class Action {
    abstract public function run(array $params); 
    abstract public function help(); 
    public function templet($templet, $new_file, $params){
        $controller_templet = fread(fopen($templet, "r"), filesize($templet));

        foreach($params as $param => $value){       
            $controller_templet = str_replace("{".$param."}", $value, $controller_templet);
        }
        $new_controller = fopen($new_file, "w+");
        fwrite($new_controller, $controller_templet); 
        // return $controller_templet; 
    }
}