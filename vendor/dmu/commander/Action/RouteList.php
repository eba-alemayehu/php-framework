<?php

namespace Commander\Action;

use Application\Http\Router;

class RouteList extends Action{
    public $action = "route:list"; 

    public function help(){
        return "List all routes"; 
    }
    
    public function run($args)
    {
        $router = new Router(false); 
        $routes = $router->loadRouter(); 

        foreach($routes as $route){
            echo $route->url.'/n'; 
            // echo $route->controller; 
            // echo implode(',', $route->middlewares);
        }
    }
}