<?php

namespace Application\Commander\Action; 

class Controller{
    public function __construct($args)
    {
        $controller_templet = fread(fopen(APPLICATION_ROOT."/vendor/Application/Commander/Action/Templets/controller.php", "r"),
        filesize(APPLICATION_ROOT."/vendor/Application/Commander/Action/Templets/controller.php"));
        if(isset($args[3])){
            $controller_templet = str_replace("{name}", $args[3], $controller_templet);
        }else{
            die("module name and controller name is not supplied"); 
        }

        $new_controller = fopen(APPLICATION_ROOT."/app/Http/Controllers/".$args[3]."Controller.php", "w+");
        fwrite($new_controller, $controller_templet); 
    }
}