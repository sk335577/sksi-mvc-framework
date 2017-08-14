<?php

namespace SKSI\Lib\Framework;

use SKSI\Lib\Framework\Application;

class Router {

    protected $routes;
    protected $params;

    public function addRoutes($routes) {
        foreach ($routes as $route) {
            $route_pattern = $route[0]; //dynamic route
            $route_params = array();
            if (isset($route[1])) {
                $route_params = $route[1]; //route params
            }

            // Convert the route to a regular expression: escape forward slashes
            $route_pattern = preg_replace('/\//', '\\/', $route_pattern);

            // Convert variables e.g. {controller}
            $route_pattern = preg_replace('/\{([a-z]+)\}/', "(?<$1>[a-z-]+)", $route_pattern);

            // Convert variables with custom regular expressions e.g. {id:\d+}
            $route_pattern = preg_replace('/\{([a-z]+):([^\}]+)\}/', "(?<$1>$2)", $route_pattern);

            // Add start and end delimiters, and case insensitive flag
            $route_pattern = '/^' . $route_pattern . '$/i';
            $this->routes[$route_pattern] = $route_params;
        }
    }

    public function getRoutes() {
        return $this->routes;
    }

    public function match($url) {
        $url = $this->filterUrl($url);
        $route_params = array();

        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches) === 1) {
                $route_params = array();
                foreach ($params as $key => $value) {
                    $route_params[$key] = $value;
                }
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $route_params[$key] = $match;
                    }
                }
            }
        }

        if (!empty($route_params)) {
            $this->params = $route_params;
            return true;
        }

        return false;
    }

    public function getParams() {
        return $this->params;
    }

    public function dispatch(Application $app) {
        $controller = $this->params['controller'];
        $controller = $this->convertToStudlyCaps($controller);
        $controller = $this->getNamespace() . $controller;

        if (class_exists($controller)) {

            $controller_obj = new $controller($app->getConfig(), $app->services());
            if (!isset($this->params['action'])) {
                $this->params['action'] = 'index';
            }

            $controller_obj->setParams($this->params);
            $action = $this->params['action']; //get the action to call
            $action = $this->convertToCamelCase($action);

            if (is_callable(array($controller_obj, $action))) {
                $controller_obj->$action();
            }
            else {
                throw new \Exception("Method $action (in controller $controller) not found");
            }
        }
        else {
            throw new \Exception("Controller class $controller not found");
        }
    }

    public function route($url) {
        $url = $this->removeQueryStringVariables($url);
        if ($this->match($url)) {
            return true;
        }
        else {
            return false;
        }
    }

    protected function convertToStudlyCaps($str) {
        return str_replace(' ', '', ucfirst(str_replace('-', ' ', $str)));
    }

    protected function convertToCamelCase($str) {
        return lcfirst($this->convertToStudlyCaps($str));
    }

    protected function removeQueryStringVariables($url) {
        if (!empty($url)) {
            $parts = explode('&', $url, 2);
            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            }
            else {
                $url = '';
            }
        }
        return $url;
    }

    protected function getNamespace() {
        return '\SKSI\App\Src\Controllers\\' . ((array_key_exists('namespace', $this->params)) ? $this->params['namespace'] . '\\' : '');
    }

    protected function filterUrl($url) {
        if (preg_match('/(?<url>.+)\/$/', $url, $matches) === 1) {
            $url = $matches['url'];
        }
        $url = trim($url);
        return $url;
    }

}
