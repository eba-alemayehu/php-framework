<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/15/19
 * Time: 10:59 PM
 */

namespace Application\Http;

use Application\Foundation\Request;
use Reflection;

class Router
{
    private $routes; 
    private $prefix; 
    private $middleware; 
    public $route;

    public function __construct($find_current_route = true)
    {
        $this->routes = []; 
        $this->route = null; 
        $this->middleware = null; 
        $this->prefix = null; 

        require(APPLICATION_ROOT."routes/router.php");

        if($find_current_route)
            foreach($this->routes as $route){
                if($route->method == Request::getMethod() && $route->url == self::url()){ 
                    $this->route = $route; 
                    break; 
                }
            }
    }

    public function __set($name, $value){
        if($name == "middleware"){
            if(is_string($value)){ 
                $this->middleware = [ucfirst($value)]; 
            }    
        }
    }
    public function loadRouter(){
       return $this->routes; 
    }

    public static function url(){
        if(isset($_GET['url'])){
            return $_GET["url"];
        }else{
            return (isset($_SERVER['PATH_INFO'])?$_SERVER['PATH_INFO']:"/"); 
        }
    }

    public static function params(){
        $method = Request::getMethod();
        if(isset(self::loadRouter()[$method][self::url()])){
            return self::loadRouter()[$method][self::url()];
        }else{
            http_response_code(404);
            require_once (APPLICATION_ROOT."app/Resource/views/error/404.php");
            die();
        }
    }

    public static function middlewares(){
        return self::params()["middleware"];
    }

    public function route(string $method, string $url, string $controller, $midelware = [])
    {
        $route = new Route; 
        $route->method = $method; 
        $route->url = ($this->prefix == null)? $url: $this->prefix . $url; 
        $route->controller = $controller; 
        $route->middlewares = (!is_array($this->middleware))? $midelware: array_merge($this->middleware, $midelware); 
    
        array_push($this->routes, $route); 

        return $route; 
    }

    public function get(string $url, string $controller, $midelware = []){
        return $this->route('GET', $url, $controller, $midelware); 
    }

    public function post(string $url, string $controller, $midelware = []){
        return $this->route('POST', $url, $controller, $midelware); 
    }

    public function put(string $url, string $controller, $midelware = []){
        return $this->route('PUT', $url, $controller, $midelware); 
    }

    public function delte(string $url, string $controller, $midelware = []){
        return $this->route('DELETE', $url, $controller, $midelware); 
    }

    public function group($params, $callback){
        $this->prefix = isset($params['prefix'])? $params["prefix"]: $this->prefix; 
        $this->middleware = isset($params['middleware'])? $params["middleware"]: $this->middleware; 
        $callback(); 
        $this->prefix = null; 
        $this->middleware = null; 
    }

    public function prefix(string $prefix){
        $this->prefix = $prefix; 
        return $this; 
    }

    public function middleware($middleware){
        $this->middleware = $middleware; 
        return $this; 
    }

    public function endPrefix(){
        $this->prefix = null; 
        return $this; 
    }

    public function endMiddleware($middleware){
        $this->middleware = null; 
        return $this; 
    }

    public function controller(string $url, string $controller, $middleware = []){
        $class = new \ReflectionClass("\\App\\Http\\Controllers\\".$controller);
        $methods = $class->getMethods(\ReflectionMethod::IS_PUBLIC);
        
        foreach($methods as $method){

            $requestMethod = strtoupper(preg_split('/(?=[A-Z_])/',$method->name)[0]);
            $this->route($requestMethod, $url.'/'.ltrim($method->name, strtolower($requestMethod)), $controller.'@'.$method->name); 
        }
        return $this;
    }
}