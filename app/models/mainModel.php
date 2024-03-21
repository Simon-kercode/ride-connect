<?php

namespace app\models;

class MainModel extends DbConnector {

    // db's table
    protected $table;

    // db's instance
    private $db;

    public function request(string $sql, array $params = null) {
        // getting DbConnector instance
        $this->db = DbConnector::getInstance();

        if ($params !== null) {
            // prepared request
            $query = $this->db->prepare($sql);
            $query->execute($params);

            return $query;
        }
        else {
            // simple request
            return $this->db->query($sql);
        }

    }

    public function findAll() {
        $query= $this->query("SELECT * FROM ".$this->table);
        return $query->fetchAll();
    }

    // method to find one or more items by some criterias
    public function findBy(array $criteria) {
        $fields = [];
        $values = [];
        
        foreach($criteria as $field => $value){
            $fields[] = "$field = ?";
            $values[] = $value;
        }
        // transforms fields array into a string
        $fieldsList = implode(' AND ', $fields);

        $result = $this->request('SELECT * FROM '.$this->table.' WHERE '.$fieldsList, $values)->fetchAll();
        return $result;
    }

    public function find(int $id) {
        $result = $this->request('SELECT * FROM '.$this->table.' WHERE id = '.$id)->fetch();
    }
}