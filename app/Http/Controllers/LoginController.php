<?php 

namespace App\Http\Controllers;

use App\User;
use Application\Framework\Support\Auth;
use Application\Framework\Support\Response;
use Application\Framework\Support\View;

class LoginController{
    public function index(){
        return View::view("login");
    }
    public function login(){

        if(Auth::login($_POST["username"], $_POST["password"])){
            Response::redirect("dashboard");
        }else{
            Response::redirect("login");
        }
    }
}