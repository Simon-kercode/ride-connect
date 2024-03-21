<?php

namespace app\models;

class UserModel extends mainModel {

    protected int $idUser;
    private string $pseudo;
    private string $password;
    private string $email;
    private string $name;
    private string $firstname;
    private bool $isAdmin;


    public function __construct(string $email, string $password, string $pseudo, string $name, string $firstname, bool $isAdmin) {
        $this->email = $email;
        $this->password = $password;
        $this->pseudo = $pseudo;
        $this->name = $name;
        $this->firstname = $firstname;
        $this->isAdmin = $isAdmin;
    }

    public function createUser(array $params) {
        $sql = "INSERT INTO `user` VALUES (?, ?, ?, ?, ?)";
        // prepare values to execute the query
        $values = [
            $params['email'],
            $params['password'],
            $params['pseudo'],
            $params['name'],
            $params['firstname']
        ];
        $result = $this->request($sql, $values);

        return $result; 
    }

    public function findUserBy(array $params) {
        $fields = [];
        $values = [];
        
        foreach($criteria as $field => $value){
            $fields[] = "$field = ?";
            $values[] = $value;
        }
        // transforms fields array into a string
        $fieldsList = implode(' AND ', $fields);

        $result = $this->request('SELECT * FROM `user` WHERE '.$fieldsList, $values)->fetchAll();
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
        $result = $this->request('UPDATE `user` SET '.$fieldsList. 'WHERE id='.$idUser, $valeurs);

        return $result;
    }
    
    public function deleteUser(){
        $result = $this->request('DELETE FROM `user` WHERE id='.$idUser);

        return $result;
    }
}