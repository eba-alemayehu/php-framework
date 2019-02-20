<?php 

namespace App\Http\Controllers;

use App\User;
use Application\Framework\Foundation\Request;
use Application\Framework\Support\Auth;
use Application\Framework\Support\File;
use Application\Framework\Support\Response;
use Application\Framework\Support\View;
use Application\Framework\Support\Session;

class AccountController{
    public function signup(){
        return View::view("signup")->with("auth", null);
    }

    public function register(){
        $user = new User();
        $_REQUEST['role_id'] = 3;
        $_REQUEST['setup'] = 1;
        $_REQUEST['password'] = md5($_REQUEST['password']);

        if($_REQUEST['password'] != $_REQUEST['confirm_password']){
            Response::redirect('signup?err_msg=password confimration do not match');
            return;
        }
        $user_pre = new User();
        if(count($user_pre->where("username", $_REQUEST['username'])->get())> 0){
            Response::redirect('signup?err_msg=user already exist');
            return;
        }

        $newUser= $user->insert( Request::allExcept(["confirm_password"]));
        Session::set("id", $newUser->id);
        Response::redirect('dashboard');
    }

    public function usersList(){

        $user = new User();
        $users = $user->orderBy("created_at", "DESC")->get();
        return  View::view("admin/users")->with("users",$users);
    }

    public function newUser(){
        $user = new User();
        $_REQUEST['password'] = $this->rand_str(6);
        $maild = mail($_REQUEST['email'],"Your liborary password", $_REQUEST['password']);
        $_REQUEST['password'] = md5($_REQUEST['password']);
        $_REQUEST['role_id'] = 2;
        $user= $user->insert( Request::all());
        Response::redirect("users?success_msg=you have successfully registerd ".$user->firstname);
    }

    public function createUser(){
        return View::view("admin/create user");
    }

    private function rand_str($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function logout(){
        session_start();
        unset($_SESSION);
        session_destroy();
        Response::redirect('/login');
    }

    public function changePassword(){
        $password = $_GET['password'];

        $user = new User();
        return $user->where("id", Auth::id())->update([
            "password" => md5($password),
            "setup" => 1
        ]);
    }

    public function profile(){
        return View::view("profile");
    }
    public function profile_pic(){
        $user = new User();

        $file =  File::store("profile_pic", "profile_pic/", $user->find(Auth::user()->id)->username);
        $user->update(["profile_pic"=> $file->relative_path_file]);
        Response::redirect("profile?success_meg=You have succesfuly changed your profile pic");
    }
}