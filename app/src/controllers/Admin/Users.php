<?php

namespace SKSI\App\Src\Controllers\Admin;

use \SKSI\Lib\Framework\Controller as AbstractController;
use SKSI\App\Src\Models\User;

class Users extends AbstractController {

    public function indexAction() {
        echo "index()";
    }

    public function listAction() {
        $users = new User();
//        $users->getAll();
        echo "<pre>";
        print_r($users->getAll_MysqliDB());
        echo "</pre>";
    }

}
