<?php

namespace SKSI\Lib\Framework\Config;

class AliasFacade {

    protected static $instance;

    public static function __callStatic($method, $args) {

        return call_user_func_array(array(static::$instance, $method), $args);
    }

    public static function setInstance($ConfigInstance) {
        static::$instance = $ConfigInstance;
    }

}
