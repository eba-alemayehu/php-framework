<?php



$this->get('/', "HomeController@index")->middelware('Auth'); 
$this->post('/', "HomeController@store"); 

$this->group(["prefix" => "/x", "middleware" => ["Auth"]], function(){
    $this->get('/home', "HomeController@store"); 
}); 

$this->prefix("/y")
->get('/home', "HomeController@store"); 

$this->controller("/x", "HomeController");
