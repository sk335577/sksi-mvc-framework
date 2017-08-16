<?php

namespace SKSI\Lib\Framework;

use PDO;
use SKSI\Lib\Framework\Config\Manager as ConfigManager;

abstract class Model {

    /**
     * Get the PDO database connection
     *
     * @return mixed
     */
    protected static function getDBPDO() {
        static $db = null;
        if ($db === null) {
            $dsn = 'mysql:host=' . ConfigManager::getDatabase('drivers.mysql.host') . ';dbname=' . ConfigManager::getDatabase('drivers.mysql.database') . ';charset=utf8';
            $db = new PDO($dsn, ConfigManager::getDatabase('drivers.mysql.username'), ConfigManager::getDatabase('drivers.mysql.password'));
            // Throw an Exception when an error occurs
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return $db;
    }

    protected static function getDBMysqli() {
        static $db = null;
        if ($db === null) {
            $db = new \mysqli(ConfigManager::getDatabase('drivers.mysql.host'), ConfigManager::getDatabase('drivers.mysql.username'), ConfigManager::getDatabase('drivers.mysql.password'), ConfigManager::getDatabase('drivers.mysql.database'));
        }
        return $db;
    }

}
