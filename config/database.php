<?php

return [

    'default' => [
        'host' => env('DB_HOST', 'localhost'),
        'username' => env('DB_USERNAME', 'root'),
        'password' => env('DB_PASSWORD', 'secret'),
        'dbname' => env('DB_DATABASE', 'repository'),
        'port' => env('DB_PORT', 3306),
        'charset' => env('DB_CHARSET', 'utf8'),
        'adapter' => 'mysql',
    ],

];
