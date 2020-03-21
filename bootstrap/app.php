<?php

require_once "../vendor/autoload.php"; 

$kernel = new Application\Kernel();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__."/../");
$dotenv->load();

var_dump(getenv('DB_USERNAME', 'root')); 