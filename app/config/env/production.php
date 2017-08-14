<?php

return [
    /*
     * Set debugging level
     * 0 - Turn off debugging. Show "Something went wrong" message ambiguously
     * 1 - Show simple error message, file and the line occured
     * 2 - Advanced debugging with code snippet, stack frames, and envionment details
     */
    'debug' => 0,
//Database Starts Here
    'driver' => 'mysql',
    'drivers' => array(
        'sqlite' => array(
            'database' => 'database.sqlite',
            'prefix' => ''
        ),
        'mysql' => array(
            'host' => 'localhost',
            'database' => 'blog',
            'username' => 'blogger',
            'password' => 'hunter2',
            'charset' => 'utf8',
            'prefix' => ''
        )
    ),
    //Database Ends Here  
    'mail' => array(
        'fromName' => 'Vokuro',
        'fromEmail' => 'phosphorum@phalconphp.com',
        'smtp' => array(
            'server' => 'smtp.gmail.com',
            'port' => 587,
            'security' => 'tls',
            'username' => '',
            'password' => ''
        )
    ),
    // Set to false to disable sending emails (for use in test environment)
    'useMail' => true
];

