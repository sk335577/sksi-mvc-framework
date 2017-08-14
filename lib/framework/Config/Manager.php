<?php

namespace SKSI\Lib\Framework\Config;

class Manager {

    protected $found = false;
    protected $currentItem = array();
    protected $commonSettings = array();

    public function __construct($path = null, $alias = null) {
        if (is_null($path)) {
            throw new \Exception("Path required to load configuration files from");
        }

        if (!count($this->commonSettings)) {
            $this->load($path);
        }

        if ($alias) {
            AliasFacade::setInstance($this);
            class_alias(__NAMESPACE__ . '\AliasFacade', $alias);
        }
    }

    public function __call($method, $params = null) {
        try {
            $methodPrefix = substr($method, 0, 3);
            $methodName = substr($method, 3);

            // This part will set properties using set
            if ($methodPrefix == 'set') {
                if (count($params) < 2) {
                    $message = "Invalid parameter(s) given, method <strong>$method</strong> requires 2";
                    $message .= " parameter(s),  but " . count($params) . " given!";
                    throw new \Exception($message);
                }

                $key = strtolower($methodName) . '.' . $params[0];
                $value = $params[1];
                $this->array_set($this->commonSettings, $key, $value);
                return $this;
            }

            // This part will return properties using get
            elseif ($methodPrefix == 'get') {

                // Set default value to return when no properties found
                $default = count($params) === 2 && !is_callable($params[1]) ? $params[1] : ( count($params) === 2 && $params[0] === '' ? strtolower($methodName) : null );

                if ($params == null) {
                    $key = strtolower($methodName);
                    if ($key === 'all')
                        $result = $this->commonSettings;
                    else
                        $result = $this->array_get($this->commonSettings, $key);
                }
                else {
                    $key = strtolower($methodName);
                    $key .= isset($params[0]) ? '.' . $params[0] : '';

                    // If a closure is given in 2nd argumet with getMethod(), call it
                    $result = $this->array_get($this->commonSettings, $key, $default);
                    if (isset($params[1]) && is_callable($params[1])) {
                        return $params[1]($result);
                    }
                }
                return $result;
            }
            else {
                throw new \Exception("Undefined method <strong>$method</strong> has been called!");
            }
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    public function load(array $settings) {
        foreach ($settings as $key => $value) {
            $this->commonSettings[$key] = $value;
        }
    }

    private function array_get($array, $key, $default = null) {
        if (is_null($key))
            return $array;
        foreach (explode('.', $key) as $segment) {
            if (!is_array($array) or ! array_key_exists($segment, $array)) {
                return $default;
            }
            $array = $array[$segment] ? : $default;
        }
        return $array;
    }

    private function array_set(&$array, $key, $value) {
        if (is_null($key))
            return $array = $value;

        $keys = explode('.', $key);
        while (count($keys) > 1) {
            $key = array_shift($keys);
            if (!isset($array[$key]) or ! is_array($array[$key])) {
                $array[$key] = array();
            }
            $array = & $array[$key];
        }
        $array[array_shift($keys)] = $value;
    }

    public function find($item = null, $array = null) {
        if (is_null($item))
            return null;
        //$this->found = false;

        if (strpos($item, '.')) {
            $arr = explode('.', $item);
            if (count($arr) > 2) {
                $itemToSearch = join('.', array_slice($arr, 1));
            }
            else {
                $itemToSearch = $arr[1];
            }
            return $this->findItemIn($itemToSearch, $arr[0]);
        }
        else {
            $array = !is_null($array) ? $array : $this->commonSettings;
            foreach ($array as $key => $value) {
                if ($key === $item) {
                    $this->currentItem = $value;
                    $this->found = true;
                    break;
                }
                else {
                    if (is_array($value)) {
                        $this->find($item, $value);
                    }
                }
            }
        }

        if (!$this->found) {
            return false;
        }
        return $this->currentItem;
    }

    private function findItemIn($item, $key) {
        $array = $this->find($key);
        if ($array)
            return $this->array_get($array, $item);
        return false;
    }

    public function isExist($key = null) {
        return $key = is_null($key) ? false : ($this->find($key) ? true : false);
    }

}
