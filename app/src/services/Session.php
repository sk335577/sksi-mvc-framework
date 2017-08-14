<?php

namespace SKSI\App\Src\Services;

class Session {

    private static $_instance = null;

    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    public function exists($name) {
        return (isset($_SESSION[$name]) ? true : false);
    }

    public function put($name, $value) {
        return $_SESSION[$name] = $value;
    }

    public function push($key, $value, $section = null) {
//        TODO: find away to push data in session  we will send like section/key
        if (is_null($section)) {
            $_SESSION[$key][] = $value;
        }
        else {
            $_SESSION[$section][$key][] = $value;
        }
    }

    public static function get($name) {
        return $_SESSION[$name];
    }

    public static function delete($name) {
        if (self::exists($name)) {
            unset($_SESSION[$name]);
        }
    }

    public static function flash($name, $string = '') {
        if (self::exists($name)) {
            $session = self::get($name);
            self::delete($name);
            return $session;
        }
        else {
            self::put($name, $string);
        }
    }

}
