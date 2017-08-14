<?php

namespace SKSI\Lib\Framework;

use SKSI\Lib\Framework\Router;
use SKSI\Lib\Framework\Services;
use SKSI\Lib\Framework\Events;

class Application {

    protected $config;
    protected $router;
    protected $request;
    protected $services;
    protected $events;

    public function __construct($config = array()) {

        $this->registerConfig($config);

        $this->registerRouter(new Router());
        $this->registerServices(new Services());
        $this->registerEvents(new Events());

        /* Load routes */
        if (isset($this->config['routes'])) {
            $this->router->addRoutes($this->config['routes']);
        }

        /* Load services */
        if (isset($this->config['services'])) {
            foreach ($this->config['services'] as $name => $service) {
                $this->services->set($name, $service);
            }
        }

        /* Load events */
        if (isset($this->config['events'])) {
            foreach ($this->config['events'] as $event) {
                if (isset($event['name']) && isset($event['action'])) {
                    $this->events->on($event['name'], $event['action'], ((isset($event['priority'])) ? $event['priority'] : 0));
                }
            }
        }
    }

    public function registerConfig(array $config) {
        $this->config = $config;
        return $this;
    }

    public function registerRouter(Router $router) {
        $this->router = $router;
        return $this;
    }

    public function registerServices(Services $services) {
        $this->services = $services;
        return $this;
    }

    public function registerEvents(Events $events) {
        $this->events = $events;
        return $this;
    }

    public function getService($name) {
        return $this->services->get($name);
    }

    public function services() {
        return $this->services;
    }

    public function getConfig() {
        return $this->config;
    }

    public function run() {

        $this->events->trigger('before.app.route', array('app' => $this));

        if ($this->router->route($_SERVER['QUERY_STRING'])) {
            $this->events->trigger('before.app.dispatch', array('app' => $this));
            $this->router->dispatch($this);
            $this->events->trigger('after.app.dispatch', array('app' => $this));
        }
        else {
            //not route found
        }

        $this->events->trigger('after.app.route', array('app' => $this));
    }

}
