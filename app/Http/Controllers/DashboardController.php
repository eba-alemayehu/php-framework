<?php 

namespace App\Http\Controllers;

use Application\Framework\Support\Auth;
use Application\Framework\Support\View;

class DashboardController{
    public function index(){
        return  View::view("dashboard");
    }
}