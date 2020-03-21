<?php 

namespace App\Http\Controllers;

use Application\Support\View;

class HomeController{
    public function index(){
        return View::view('home'); 
    }

}