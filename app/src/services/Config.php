<?php

namespace SKSI\App\Src\Services;

use SKSI\Lib\Framework\Config\Manager as ConfigManager;

class Config extends ConfigManager {

    private static $_instance = null;

    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    public function check() {
        static $c = 0;
        $c = $c + 1;
        echo $c;
    }

    public function init($app) {
        $arg = func_get_args();
        echo "<pre>";
        print_r($arg);
        echo "</pre>";
    }

}
