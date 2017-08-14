<?php

require_once SKSI_ROOT . '/lib/framework/autoloader.php';

session_start();

$app = new SKSI\Lib\Framework\Application(include SKSI_ROOT . '/app/config/application.php');
$app->run();
