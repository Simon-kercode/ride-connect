<?php

namespace app\models;

class Model extends DbConnector {

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
    public function findBy(array $params) {
        $fields = [];
        $values = [];
        
        foreach($params as $field => $value){
            $fields[] = "$field = ?";
            $values[] = $value;
        }
        // transforms fields array into a string
        $fieldsList = implode(' AND ', $fields);

        $result = $this->request('SELECT * FROM '.$this->table.' WHERE '.$fieldsList, $values)->fetchAll();
        return $result;
    }
    // method to find one item by its id
    public function find(int $id) {
        $result = $this->request('SELECT * FROM '.$this->table.' WHERE id = ?', [$id])->fetch();
    }

    // method to create an item 
    public function create(Model $model){
        $fields = [];
        $inter = [];
        $values = [];

        foreach($model as $field => $value) {
            if($value !== null && $field != 'db' && $field != 'table') {
                $fields[] = $field;
                $inter[] = '?';
                $values[] = $value;
            }
        }
        // transforming arrays into strings
        $fieldsList = implode(', ', $champs);
        $interList = implode(', ', $inter);

        $result = $this->request('INSERT INTO '.$this->table.' ('.$fieldsList.')VALUES('.$interList.')', $values);
    }

    // method to update an item
    public function update(int $id, Model $model) {
        $fields = [];
        $values = [];

        foreach($model as $field => $value) {
            if($value !== null && $field != 'db' && $field != 'table') {
                $fields[] = "$field = ?";
                $values[] = $value;
            }
        }  
        // placing $id at the last index of the array
        $values[] = $id;

        // transforming array into string
        $fieldsList = implode(', ', $fields);

        $result = $this->request('UPDATE '.$this->table.' SET '. $fieldsList.' WHERE id = ?', $values);
    }

    public function delete(int $id) {
        $result = $this->request ('DELETE FROM '.$this->$table.' WHERE id = ?', [$id]);
    }
}