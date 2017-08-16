<?php

/* Services are global functionalities which can be accessed from any where of the application */

return[
    'services' =>
    [
//        'config' => [
//            'call' => '\SKSI\App\Src\Services\Config::init',
//            'params' => [
//                'config' => SKSI_ROOT . '/app/config/application.php',
//            ]
//        ],
//        'database' => [
//            'call' => '\SKSI\App\Src\Services\Database',
//            'params' => [
//                'host' => \SKSI\Lib\Framework\Config\Manager::getDatabase('drivers.mysql.host'),
//                'user' => \SKSI\Lib\Framework\Config\Manager::getDatabase('drivers.mysql.user'),
//                'password' => \SKSI\Lib\Framework\Config\Manager::getDatabase('drivers.mysql.password'),
//                'database' => \SKSI\Lib\Framework\Config\Manager::getDatabase('drivers.mysql.database'),
//            ]
//        ],
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
