<?php

namespace SKSI\Lib\Framework;

use SKSI\Lib\Framework\Application;
use SKSI\Lib\Framework\View;

abstract class Controller {

    protected $params;
    protected $app;

    public function __construct(Application $app) {
        $this->view = new View($app->configs()['paths']['views']);
        $this->view->setTranslator($app->services()->get('translator'));
    }

    public function services($service) {
        return $this->app->services()->get($service);
    }

    public function setParams($params) {
        $this->params = $params;
    }

    public function getParams() {
        return $this->params;
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
