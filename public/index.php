<?php

define("SKSI_ROOT", dirname(dirname(__FILE__)));

if (getenv('SKSI_ENVIRONMENT') === false) {
    putenv('SKSI_ENVIRONMENT=local');
}

require_once SKSI_ROOT . '/lib/framework/bootstrap.php';


