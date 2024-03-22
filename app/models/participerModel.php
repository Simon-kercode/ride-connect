<?php

namespace app\models;

class ParticiperModel extends Model {

    private int $idUser;
    private int $idBalade;

    public function __construct($idUser, $idBalade) {
        $this->idUser = $idUser;
        $this->idBalade = $idBalade;
    }

    public function createParticipant(array $params) {
        $sql = "INSERT INTO `participer` VALUES (?, ?)";

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

        $result = $this->request('SELECT * FROM `participant` WHERE '.$fieldsList, $values)->fetchAll();
        return $result;
    }

    public function deletePhoto(int $idUser) {
        $result = $this->request('DELETE FROM `participant` WHERE id='.$idUser);

        return $result;
    }
}