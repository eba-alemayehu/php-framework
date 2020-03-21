<?php 

return [
    'db_connection' => env('DB_CONNECTION', 'mysql'), 
    'db_host' => env('DB_HOST', 'localhost'),
    'db_name' => env('DB_NAME', 'mydb'),
    'db_port' => env('DB_PORT', '3306'), 
    'db_username' => env('DB_USERNAME', 'root'),
    'db_password' => env('DB_PASSWORD', '')
]; 