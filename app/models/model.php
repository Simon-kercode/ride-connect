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

    public function findOneByOneParam(string $field, string $value) {
        $result = $this->request('SELECT * FROM '.$this->table.' WHERE '.$field.'= ?', [$value])->fetch();
        return $result;
    }

    public function addBalade(array $params) {
        $sql = "INSERT INTO `balade` (title, date, time, length, duration, difficulty, partNumber, startPoint, arrival, department, region, meetingPoint, precisions, waypoints, idUser) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $values = [
            $params['title'],
            $params['date'],
            $params['time'],
            $params['length'],
            $params['duration'],
            $params['difficulty'],
            $params['partNumber'],
            $params['startPoint'],
            $params['arrival'],
            $params['department'],
            $params['region'],
            $params['meetingPoint'],
            $params['precisions'],
            $params['waypoints'],
            $params['idUser']
        ];
        $result = $this->request($sql, $values);
        return $result;
    }
    // method to create an item 
    public function create(){
        $fields = [];
        $inter = [];
        $values = [];

        foreach($this as $field => $value) {
            if($value !== null && $field != 'db' && $field != 'table' && $field != 'idUser') {
                $fields[] = $field;
                $inter[] = '?';
                $values[] = $value;
            }
        }
        // transforming arrays into strings
        $fieldsList = implode(', ', $fields);
        $interList = implode(', ', $inter);

        $result = $this->request('INSERT INTO '.$this->table.' ('.$fieldsList.')VALUES('.$interList.')', $values);
        return $result;
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

    // method to delete an item
    public function delete(int $id) {
        $result = $this->request ('DELETE FROM '.$this->$table.' WHERE id = ?', [$id]);
    }
}