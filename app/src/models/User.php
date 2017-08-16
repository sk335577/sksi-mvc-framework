<?php

namespace SKSI\App\Src\Models;

use PDO;
use SKSI\Lib\Framework\Model as AbstractModel;

class User extends AbstractModel {

    public static function getAll_PDO() {
        $db = static::getDB();
        $stmt = $db->query('SELECT * FROM xx_users');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getAll_MysqliDB() {
        $db = new \MysqliDb(static::getDBMysqli());
        return $db->get('xx_users');
    }

}
