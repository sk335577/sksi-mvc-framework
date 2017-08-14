<?php

namespace SKSI\Lib\Framework;

use SKSI\Lib\Framework\Services;
use SKSI\Lib\Framework\View;

abstract class Controller {

    private $params;
    protected $config;
    protected $services;

    public function __construct($config, Services $services) {

        $this->setServices($services);
        $this->setConfig($config);
        $this->view = new View($this->config['paths']['views']);
        $this->view->setTranslator($this->services()->get('translator'));
    }

    public function setParams($params) {
        $this->params = $params;
    }

    public function setServices($services) {
        $this->services = $services;
    }

    public function services() {
        return $this->services;
    }

    public function getParams() {
        return $this->params;
    }

    public function setConfig($config) {
        $this->config = $config;
    }

    public function __call($name, $args) {
        $method = $name . 'Action';
        if (method_exists($this, $method)) {
            if ($this->before() !== false) {
                call_user_func_array(array($this, $method), $args);
                $this->after();
            }
        }
        else {
            throw new \Exception("Method $method not found in controller " . get_class($this));
        }
    }

    protected function before() {
        
    }

    protected function after() {
        
    }

}
