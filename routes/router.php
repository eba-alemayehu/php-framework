<?php

return [
    "GET" => [
        "/" => [ "middleware" => [], "controller" => "DashboardController@index" ],
        "/login" => [ "middleware" => ["Gust"], "controller" => "LoginController@index"],
        "/signup" => [ "middleware" => [], "controller" => "AccountController@signup"],
        "/dashboard" => [ "middleware" => ["Auth"], "controller" => "DashboardController@index"],
        "/users" => [ "middleware" => ["Auth"], "controller" => "AccountController@usersList"],
        "/create user" => [ "middleware" => ["Auth"], "controller" => "AccountController@createUser"],
        "/upload" => [ "middleware" => ["Auth"], "controller" => "UploadController@index"],
        "/books" => [ "middleware" => ["Auth"], "controller" => "BookController@index"],
        "/add book" => [ "middleware" => ["Auth"], "controller" => "BookController@addBook"],
        "/search" => [ "middleware" => ["Auth"], "controller" => "BookController@search"],
        "/book detail" => [ "middleware" => ["Auth"], "controller" => "BookController@detail"],
        "/logout" => [ "middleware" => ["Auth"], "controller" => "AccountController@logout"],
        "/rate"  => [ "middleware" => ["Auth"], "controller" => "BookController@rate"],
        "/profile"  => [ "middleware" => ["Auth"], "controller" => "AccountController@profile"],
    ],
    "POST" => [
        "/login" => [ "middleware" => [], "controller" => "LoginController@login"],
        "/signup" => [ "middleware" => [], "controller" => "AccountController@register"],
        "/create user" => [ "middleware" => [], "controller" => "AccountController@newUser"],
        "/add book" => [ "middleware" => ["Auth"], "controller" => "BookController@register"],
        "/upload" => [ "middleware" => ["Auth"], "controller" => "UploadController@upload"],
        "/logout" => [ "middleware" => ["Auth"], "controller" => "AccountController@logout"],
        "/change password" => [ "middleware" => ["Auth"], "controller" => "AccountController@changePassword"],
        "/profile_pic" => [ "middleware" => ["Auth"], "controller" => "AccountController@profile_pic"],

    ]
];