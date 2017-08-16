<?php

namespace SKSI\App\Src\Services;

class Translator {

    public $lang = null;
    public $translations = array();

    public function init($config, $route_params) {
        if (isset($route_params['lang'])) {
            $this->lang = $route_params['lang'];
        }
        else {
            $this->lang = $config['languages']['default'];
        }
        $this->translations = include_once $config['languages']['path'] . '/' . $this->lang . '.php';
    }

    public function translate($string, $default = null) {
        if (isset($this->translations[$string])) {
            return $this->translations[$string];
        }
        else {
            if (!is_null($default)) {
                return $default;
            }
            else {
                return $string;
            }
        }
    }

}
