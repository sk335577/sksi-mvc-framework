<?php

/* Services are global functionalities which can be accessed from any where of the application */

return[
    'services' =>
    [
////        'database' => 'SKSI\App\Src\Services\Database::init', //singelton class,connect and return an object of database which can be used anywhere
////        'session' => 'SKSI\App\Src\Services\Session::init', //initialize a session
//            'translator' => 'SKSI\App\Src\Services\Translator', //initialize a session
        'translator' => [
            'call' => '\SKSI\App\Src\Services\Translator',
//            'params' => [
//                'adapter' => 'Sqlite',
//                'options' => [
//                    'database' => __DIR__ . '/../database/'
//                ]
//            ]
        ]
    ]
];
