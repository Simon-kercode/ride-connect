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

    // get last id inserted in db
    public function getLastId() {
        $this->db = DbConnector::getInstance();
        return $this->db->lastInsertId();
    }

    // get all from a table
    public function findAll() {
        $result = $this->request("SELECT * FROM ".$this->table);
        return $result->fetchAll();
    }

    // method to find one or more parameters of one or more items by none or some criterias
    public function findSomeBy(array $columns = [], array $params = [], $operator = 'AND') {
        if (empty($columns)) {
            $columnsList = ' * ';
        }
        else {
            $columnsList = implode(', ', $columns);
        }
        
        $where = '';
        $values = [];

        if (!empty($params)) {
            $where = ' WHERE ';
            $fields = [];

            foreach($params as $field => $value) {
                $fields[] = "$field = ?";
                $values[] = $value;
            }
            $where .= implode(' '.$operator.' ', $fields);
        }
        $result = $this->request('SELECT '.$columnsList.' FROM '.$this->table.$where, $values)->fetchAll();
        return $result;
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

    // method to find some data by some criterias and order it in a specific way
    public function findAndOrder(array $columns, array $params, $operator, $order, $way) {
        $orberBy = '';

        if(!empty($order)) {
            $orderBy = ' ORDER BY '.$order." $way";
        }

        if (empty($columns)) {
            $columnsList = ' * ';
        }
        else {
            $columnsList = implode(', ', $columns);
        }
        
        $where = '';
        $values = [];

        if (!empty($params)) {
            $where = ' WHERE ';
            $fields = [];

            foreach($params as $field => $value) {
                $fields[] = "$field = ?";
                $values[] = $value;
            }
            $where .= implode(' '.$operator.' ', $fields);
        }
        $result = $this->request('SELECT '.$columnsList.' FROM '.$this->table.$where.$orderBy, $values)->fetchAll();
        return $result;
    }
    // method to find one item by its id
    public function find(int $id) {
        $result = $this->request('SELECT * FROM '.$this->table.' WHERE id = ?', [$id])->fetch();
    }

    // method to find one item by one criteria
    public function findOneByOneParam(string $field, string $value) {
        $result = $this->request('SELECT * FROM '.$this->table.' WHERE '.$field.'= ?', [$value])->fetch();
        return $result;
    }

    // method to find data of by some criterias and by joining 2 tables
    public function findSomeWithJoin(array $columns = [], array $joinParams = [], array $params = []) {
        if (empty($columns)) {
            $columnsList = ' * ';
        }
        else {
            $columnsList = implode(', ', $columns);
        }

        $query = 'SELECT '.$columnsList.' FROM ' .$this->table;

        if (!empty($joinParams)) {
            foreach($joinParams as $joinParam) {
                $query .= ' JOIN ' .$joinParam['table'].' ON '.$joinParam['condition'];
            }
        }

        $where = '';
        $values = [];

        if (!empty($params)) {
            $where = ' WHERE ';
            $fields = [];

            foreach($params as $field => $value) {
                $fields[] = "$field = ?";
                $values[] = $value;
            }
            $where .= implode(' AND ', $fields);
        }
        $query .= $where;
        var_dump($query);
        var_dump($values);
        $result = $this->request($query, $values)->fetchAll();
        return $result;
    }

    // method to find data of by some criterias and by joining 2 tables and order it in a specific way
    public function findSomeWithJoinAndOrder(array $columns = [], array $joinParams = [], array $params = [], string $order ="", string $way = "") {
        if (empty($columns)) {
            $columnsList = ' * ';
        }
        else {
            $columnsList = implode(', ', $columns);
        }

        $query = 'SELECT '.$columnsList.' FROM ' .$this->table;

        if (!empty($joinParams)) {
            foreach($joinParams as $joinParam) {
                $query .= ' JOIN ' .$joinParam['table'].' ON '.$joinParam['condition'];
            }
        }
        $where = '';
        $values = [];

        if (!empty($params)) {
            $where = ' WHERE ';
            $fields = [];

            foreach($params as $field => $value) {
                $fields[] = "$field = ?";
                $values[] = $value;
            }
            $where .= implode(' AND ', $fields);
        }
        $query .= $where;

        $orderBy = '';

        if(!empty($order)) {
            $orderBy = ' ORDER BY '.$order." $way";
        }

        $query .= $orderBy;

        $result = $this->request($query, $values)->fetchAll();
        return $result;
    }
    public function updateBalade(array $params) {


        $values = [];
            foreach($params as $param => $value) {
                $values[] = $params[$param];
            }
        
        $result = $this->request($sql, $values);
        return $result;
    }
    // method to create an item 
    public function create(){
        $fields = [];
        $inter = [];
        $values = [];

        foreach($this as $field => $value) {
            if($value !== null && $field != 'db' && $field != 'table') {
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
    public function update(string $idColumn, int $id) {
        $fields = [];
        $values = [];

        foreach($this as $field => $value) {
            if($value !== null && $field != 'db' && $field != 'table') {
                $fields[] = "$field = ?";
                $values[] = $value;
            }
        }  
        // placing $id at the last index of the array
        $values[] = $id;

        // transforming array into string
        $fieldsList = implode(', ', $fields);

        $result = $this->request('UPDATE '.$this->table.' SET '. $fieldsList.' WHERE '.$idColumn.' = ?', $values);
        return $result;
    }

    // method to delete an item
    public function delete(int $id, string $idColumn = '') {
        $result = $this->request ('DELETE FROM '.$this->table.' WHERE '.$idColumn.' = ?', [$id]);
        return $result;
    }
}
