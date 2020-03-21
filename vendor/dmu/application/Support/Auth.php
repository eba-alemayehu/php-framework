<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/18/19
 * Time: 6:42 PM
 */

namespace Application\Support;

use App\User;

class Auth
{
    private $session;
    public function __construct()
    {
        $this->session = new Session();
    }

    public static function login($username, $password){
        $user = new User();
        $user = $user->where("username", $username)->where("password", md5($password))->first();
        if(count($user)){
            Session::set("id", $user->id);
            return true;
        }else{
            Session::set("login_err", "Invalid username or password");
            return false;
        }
    }

    public static function check(){
        return (Session::exist("id"));
    }

    public static function user(){
        if(self::check()){
            $user = new User();
            return $user->find(Session::get("id"));
        }else{
            return null;
        }
    }

    public static function id(){
        return Session::get("id");
    }

}