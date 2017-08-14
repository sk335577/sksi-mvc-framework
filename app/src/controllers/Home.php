<?php

namespace SKSI\App\Src\Controllers;

use \SKSI\Lib\Framework\Controller as AbstractController;

class Home extends AbstractController {

    public function indexAction() {
        echo "Xx";
        $this->view->setData(array('xx' => 1));
        $this->view->renderTemplate();
    }

    public function getAction() {
        echo "get()";
    }

}
