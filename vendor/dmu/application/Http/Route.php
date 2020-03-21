<?php 

namespace  Application\Http;

class Route
{   
    public $method; 
    public $url; 
    public $controller; 
    public $middlewares = []; 

    public function middelware($middleware){
        if(is_array($middleware)){
            array_merge($this->middlewares, $middleware); 
        }else{
            array_push($this->middlewares, $middleware); 
        }

        return $this; 
    }

    public function controller(){
        return explode("@",$this->controller);
    }
    public function controllerClass(){
        return "\\App\\Http\\Controllers\\".$this->controller()[0]; 
    }
    public function controllerMethod(){
        return $this->controller()[1]; 
    }

}