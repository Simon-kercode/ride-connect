<?php

namespace app\models;

class UserModel extends Model {

    protected int $idUser;
    private string $pseudo;
    private string $password;
    private string $email;
    private string $name;
    private string $firstname;
    private bool $isAdmin;


    public function __construct($email, $password) {
        $this->email = $email;
        $this->password = $password;
    }

    public function createUser(array $params) {
        $sql = "INSERT INTO `_user` (mail, password, pseudo, name, firstname) VALUES (?, ?, ?, ?, ?)";
        // prepare values to execute the query
        $values = [
            $params['email'],
            $params['password'],
            $params['pseudo'],
            $params['name'],
            $params['firstname']
        ];
        $result = $this->request($sql, $values);
        var_dump($result);
        return $result; 
    }

    public function findUserBy(array $params) {
        $fields = [];
        $values = [];
        
        foreach($params as $field => $value){
            $fields[] = "$field = ?";
            $values[] = $value;
        }
        // transforms fields array into a string
        $fieldsList = implode(' AND ', $fields);

        $result = $this->request('SELECT * FROM `_user` WHERE '.$fieldsList, $values)->fetchAll();
        return $result;
    }

    public function updateUser(int $idUser, array $params) {
        $fields = [];
        $values = [];

        foreach($params as $field => $value) {
            $fields[] = "$field = ?";
            $values[] = $value;
        }

        $fieldsList = implode(', ', $fields);
        $result = $this->request('UPDATE `_user` SET '.$fieldsList. 'WHERE id='.$idUser, $valeurs);

        return $result;
    }
    
    public function deleteUser(){
        $result = $this->request('DELETE FROM `_user` WHERE id='.$idUser);

        return $result;
    }
}