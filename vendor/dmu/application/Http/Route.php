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
            array_merge($this->middleware, $middleware); 
        }else{
            array_push($this->middleware, $middleware); 
        }
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