<?php

namespace SKSI\Application\Models;

class User {

    /**
     * Get all the users as an associative array
     *
     * @return array
     */
    public static function getAll() {
        $db = static::getDB();
        $stmt = $db->query('SELECT * FROM users');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
