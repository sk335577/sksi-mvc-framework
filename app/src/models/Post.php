<?php

namespace SKSI\Application\Models;
use PDO;
class Post extends \SKSI\Core\Model {

    /**
     * Get all the posts as an associative array
     *
     * @return array
     */
    public static function getAll() {
        $db = static::getDB();
        $statement = $db->query('SELECT * FROM posts');
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

}
