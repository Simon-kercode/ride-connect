<?php

namespace app\models;

use DbConnector;

class Model extends DbConnector {

    protected $table;
    private $db;

    public function request(string $sql, array $params = null) {
        // getting DbConnector instance
        $this->db = DbConnector::getInstance();

        if ($params !== null) {
            $query = $this->db->prepare($sql);
            $query->execute($params);

            return $query;
        }
        else {
            return $this->db->query($sql);
        }

    }

}