<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/15/19
 * Time: 10:46 PM
 */

namespace Application\Framework\Foundation;


class Request
{
    public function __construct()
    {
    }

    public static function getMethod(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(isset($_POST['_put'])){
                return 'PUT';
            }
            else if(isset($_POST['_delete'])){
                return 'DELETE';
            }else{
                return 'POST';
            }
        }else{
            return 'GET';
        }
    }

    public static function all(){
        return self::allExcept([]);
    }

    public static function allExcept($inputs = []){
        $filtered = [];
        foreach($_REQUEST as $input => $val){
            if(!in_array($input, $inputs) && $input != "url"){
                $filtered[$input] = $val;
            }
        }
        return $filtered;
    }
}