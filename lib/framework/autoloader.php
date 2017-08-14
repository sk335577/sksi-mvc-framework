<?php

require_once SKSI_ROOT . '/vendor/autoload.php';

spl_autoload_register(function ($class) {
    $class = str_replace('SKSI\\', '', $class);
    $class = str_replace('\\', '/', $class);
    $class_namespace = explode('/', $class);
    for ($i = 0; $i < (count($class_namespace) - 1); $i++) {
        $class_namespace[$i] = ($class_namespace[$i]);
    }
    $class = implode('/', $class_namespace);
    if (is_readable(SKSI_ROOT . '/' . $class . '.php')) {
        require_once SKSI_ROOT . '/' . $class . '.php';
    }
});
