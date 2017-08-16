<?php

namespace SKSI\Lib\Framework;

use SKSI\Lib\Framework\Router;
use SKSI\Lib\Framework\Services;
use SKSI\Lib\Framework\Events;
use SKSI\Lib\Framework\Dispatcher;

class Application {

    protected $config; //for the framework, we can use config class in application
    protected $router;
    protected $services;
    protected $events;
    protected $dispatcher;

    public function __construct($config = array()) {

        $this->registerConfig($config);
        $this->registerRouter(new Router());
        $this->registerDispatcher(new Dispatcher());
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
    }

    public function registerRouter(Router $router) {
        $this->router = $router;
    }

    public function registerServices(Services $services) {
        $this->services = $services;
    }

    public function registerEvents(Events $events) {
        $this->events = $events;
    }

    public function registerDispatcher(Dispatcher $dispatcher) {
        $this->dispatcher = $dispatcher;
    }

    public function configs() {
        return $this->config;
    }

    public function services() {
        return $this->services;
    }

    public function router() {
        return $this->router;
    }

    public function events() {
        return $this->events;
    }

    public function run() {

        $this->events->trigger('on.app.run', array('app' => $this));

        $this->events->trigger('before.app.route', array('app' => $this));

        if ($this->router->route($_SERVER['QUERY_STRING'])) {
            $this->events->trigger('before.app.dispatch', array('app' => $this));
            $this->dispatcher->dispatch($this);
            $this->events->trigger('after.app.dispatch', array('app' => $this));
        }
        else {
            //not route found
        }

        $this->events->trigger('after.app.route', array('app' => $this));
    }

}
