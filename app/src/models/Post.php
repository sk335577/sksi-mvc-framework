<?php

namespace SKSI\App\Src\Models;

use PDO;
use SKSI\Lib\Framework\Model as AbstractModel;

class Post extends AbstractModel {

    public function getAll() {
        $db = static::getDB();
        $statement = $db->query('SELECT * FROM posts');
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

}
