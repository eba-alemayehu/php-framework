<?php

// use Application\Http\Router;

$this->get('/', "HomeController@index"); 
$this->post('/', "HomeController@store"); 

$this->group(["prefix" => "/x", "middleware" => ["Auth"]], function(){
    $this->get('/home', "HomeController@store"); 
}); 

$this->prefix("/y")
->get('/home', "HomeController@store"); 

$this->controller("/x", "HomeController");
// var_dump($this);  
// return [
//     "GET" => [
//         "/" => [ "middleware" => [], "controller" => "HomeController@index" ],
//     ],
//     "POST" => [
        
//     ]
// ];