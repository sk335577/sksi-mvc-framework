<?php

/**
 * TODO: Should i use a database from service locator
 * 
 */

namespace SKSI\App\Src\Services;

class Database extends \mysqli {

    public function __construct($host, $user, $password, $database) {
        parent::__construct($host, $user, $password, $database);
    }

}
