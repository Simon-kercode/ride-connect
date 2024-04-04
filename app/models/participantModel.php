<?php

namespace app\models;

class ParticipantModel extends Model {

    private int $idUser;
    private int $idBalade;

    public function __construct($idUser, $idBalade) {
        $this->table = 'participate';
        $this->idUser = $idUser;
        $this->idBalade = $idBalade;
    }

    public function createParticipant(array $params) {
        $sql = "INSERT INTO $this->table VALUES (?, ?)";

        $values = [
            $params['idUser'],
            $params['idBalade'],
        ];

        $result = $this->request($sql, $values);
        return $result;
    }

    public function findParticipantBy(array $params) {
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
}