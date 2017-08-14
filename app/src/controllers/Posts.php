<?php

namespace SKSI\Application\Controllers;

use SKSI\Core\View;

class Posts extends \SKSI\Core\Controller {

    public function indexAction() {

        $data = \SKSI\Application\Models\Post::getAll();
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        View::renderTemplate('Posts/index.html', array('name' => $data));
    }

    public function getAction() {
        echo "get()";
    }

    public function editAction() {
        echo "<pre>";
        print_r($this->route_params);
        echo "</pre>";
    }

}
