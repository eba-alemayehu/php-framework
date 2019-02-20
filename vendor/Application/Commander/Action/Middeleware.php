<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/15/19
 * Time: 11:59 PM
 */

namespace Application\Commander\Action;


class Middeleware
{
    public function __construct($args)
    {
        $controller_templet = fread(fopen(APPLICATION_ROOT."/vendor/Application/Commander/Action/Templets/middeleware.php", "r"),
            filesize(APPLICATION_ROOT."/vendor/Application/Commander/Action/Templets/middeleware.php"));
        if(isset($args[3])){
            $controller_templet = str_replace("{name}", $args[3], $controller_templet);
        }else{
            die("module name and controller name is not supplied");
        }

        $new_controller = fopen(APPLICATION_ROOT."/app/Http/Middlewares/".$args[3].".php", "w+");
        fwrite($new_controller, $controller_templet);
    }
}