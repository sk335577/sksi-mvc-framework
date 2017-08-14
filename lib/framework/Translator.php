<?php

namespace SKSI\Lib\Framework;

use \SKSI\Lib\Framework\Router;

class Translator {

    private $lang;
    private $config;
    private $router;

    public function __construct(Router $router, array $config) {
        $this->config = $config;
//        $this->lang
    }

    private function setLanguage() {
        
    }

    private function loadTranslation() {
        
    }

    public function translate($string, $default = '') {
        
    }

}
