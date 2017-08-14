<?php

return array_merge(
        [
    'paths' => [
        'views' => [
            'default' => SKSI_ROOT . '/app/src/views',
            'app' => SKSI_ROOT . '/app/src/views/application',
            'errors' => SKSI_ROOT . '/app/src/views/errors',
            'layouts' => SKSI_ROOT . '/app/src/views/layouts'
        ],
    ],
    //Languages Starts Here
    'languages' => [
        'installed' => ['en', 'fr'],
        'default' => 'en',
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
