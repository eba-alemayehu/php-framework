<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/16/19
 * Time: 12:00 AM
 */

namespace App\Http\Middlewares;



class Gust
{
    public function before(){
        if(\Application\Support\Auth::check()){
            http_response_code(403); 
        }
    }
    public function after(){

    }
}