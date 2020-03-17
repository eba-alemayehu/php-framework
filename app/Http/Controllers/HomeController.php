<?php 

namespace App\Http\Controllers;

use Application\Framework\Support\View;

class HomeController{
    public function index(){
        return View::view('home'); 
    }
}