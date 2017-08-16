<?php

return[
    'events' =>
    [
        'config' => [
            'name' => 'on.app.run',
            'action' => function(SKSI\Lib\Framework\Application $app) {
                /*
                 * TODO:Use config from service manager, Remove config directory from the framework
                 */
                \SKSI\Lib\Framework\Config\Manager::init($app->configs()); //now we can access config from anywhere
            },
            'params' => [
            ]
        ],
//        'config' => [
//            'name' => 'before.app.controller.method',
//            'action' => function(SKSI\Lib\Framework\Application $app) {
//                $app->services()->get('translator')->init($app->config(), $app->router()->getParams());
//            },
//            'params' => [
//            ]
//        ],
//        'test' => [
//            'name' => 'on.app.run',
//            'action' => function(SKSI\Lib\Framework\Application $app) {
//                $app->services()->get('database');
//            },
//            'params' => [
//            ]
//        ]
    ]
];


