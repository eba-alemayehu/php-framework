<?php
namespace Commander; 
require 'Action/Controller.php'; 
define("APPLICATION_ROOT", __DIR__."/../../../");

class Kernel{

    private $arguments; 
    private $message; 


    private $actions = [
        \Commander\Action\Controller::class,
        \Commander\Action\Middeleware::class,
        \Commander\Action\Migration::class,
        \Commander\Action\Serve::class,
        \Commander\Action\Migrate::class,
        \Commander\Action\RouteList::class
    ]; 
    public function __construct($_args){
        $this->arguments = $_args; 
    }

    public function exec(){
        if(isset($this->arguments[1])){
            $action_found = false; 
            foreach($this->actions as $action){
                $action = new $action; 

                if($action->action == $this->arguments[1]){
                    array_splice($this->arguments, 0, 2); 
                    $action->run($this->arguments); 
                    $action_found = true; 
                    break; 
                }
            }

            if(!$action_found){
                throw new \Exception('Action not found'); 
            }
        }else{
            throw new \Exception('No action is specified!'); 
        }
    }

    public function terminate(){
        return $this->message; 
    }
}

?>