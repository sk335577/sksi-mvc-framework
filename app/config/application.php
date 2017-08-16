<?php

return array_merge(
        [
    'title' => 'SK Stupid Idior MVC',
    'paths' => [
        'views' => [
            'default' => SKSI_ROOT . '/app/src/views/default',
            'backend' => SKSI_ROOT . '/app/src/views/backend',
//            'app' => SKSI_ROOT . '/app/src/views/application',
//            'errors' => SKSI_ROOT . '/app/src/views/errors',
//            'layouts' => SKSI_ROOT . '/app/src/views/layouts'
        ],
    ],
    //Languages Starts Here
    'languages' => [
        'default' => 'en',
        'path' => SKSI_ROOT . '/app/lang'
    ],
    //Languages Ends Here
    'timezone' => 'Asia/kolkata'
        //
        //....
        ]
        , require __DIR__ . '/env/' . getenv('SKSI_ENVIRONMENT') . '.php'
        , require __DIR__ . '/routes.php'
        , require __DIR__ . '/services.php'
        , require __DIR__ . '/events.php'
);
