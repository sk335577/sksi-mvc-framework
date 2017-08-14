<?php

namespace SKSI\Lib\Framework;

class Services {

    private $services = array();
    private $loaded = array();

    public function get($service) {
        if (isset($this->services[$service])) {
            if (!isset($this->loaded[$service])) {

                $call = $this->services[$service]['call'];
                // If the callable is a static call
                if (strpos($call, '::')) {
                    $obj = call_user_func($call);
                    $called = true;
                    // If the callable is a instance call
                }
                else if (strpos($call, '->')) {
                    $ary = explode('->', $call);
                    $class = $ary[0];
                    $method = $ary[1];
                    if (class_exists($class) && method_exists($class, $method)) {
                        $obj = call_user_func([new $class(), $method]);
                        $called = true;
                    }
                    // Else, if the callable is a new instance/construct call
                }
                else if (class_exists($call)) {
                    $obj = new $call();
                    $called = true;
                }
                if (!$called) {
                    throw new Exception('Error: Unable to call service. The call parameter must be an object or something callable');
                }
                else {
                    $this->loaded[$service] = $obj;
                }
            }
            return $this->loaded[$service];
        }
    }

    public function set($name, $service) {

        $this->services[$name] = $service;

        return $this;
    }

}
