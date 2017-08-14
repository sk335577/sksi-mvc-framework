<?php

//dynamic routing
return ['routes' =>
    [
        //simple
        ['', ['controller' => 'Home', 'action' => 'index']],
        ['{controller}'],
        ['{controller}/{action}'],
        //paramters
        ['{controller}/{id:\d+}/{action}'],
        //language
        ['{lang:[a-z][a-z]}/{controller}'],
        ['{lang:[a-z][a-z]}/{controller}/{action}'],
        ['{lang:[a-z][a-z]}/{controller}/{id:\d+}/{action}'],
        //admin
        ['admin/{controller}/{action}'],
        ['{lang:[a-z][a-z]}/admin/{controller}/{action}'],
        ['{lang:[a-z][a-z]}/admin/{controller}/{id:\d+}/{action}'],
        ['admin/{controller}/{action}', ['namespace' => 'Admin']],
        ['{lang:[a-z][a-z]}/admin/{controller}/{action}', ['namespace' => 'Admin']],
    ]
];
