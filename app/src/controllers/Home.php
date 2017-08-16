<?php

namespace SKSI\App\Src\Controllers;

use \SKSI\Lib\Framework\Controller as AbstractController;

class Home extends AbstractController {

    public function indexAction() {
        $this->view->setData(
                array('page_title' => 'Home')
        );
        $this->view->renderTemplate('home/index', 'default', 'default');
    }

    public function getAction() {
        echo "get()";
    }

}
