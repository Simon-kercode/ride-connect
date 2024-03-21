<?php

namespace app\models;
use BaladeModel;

class PhotoModel extends MainModel {

    private int $idPhoto;
    private int $idBalade;
    private int $idUser;


    public function __construct($idPhoto, $idBalade, $idUser) {
        $this->idPhoto = $idPhoto;
        $this->idPhoto = $idPhoto;
        $this->idUser = $idUser;
    }

    public function createPhoto(array $params) {
        $sql = "INSERT INTO `photo` VALUES (?, ?, ?)";

        $values = [
            $params['idPhoto'],
            $params['idBalade'],
            $params['idUser']
        ];

        $result = $this->request($sql, $values);
        return $result;
    }

    public function updatePhoto(int $idPhoto, array $params) {
        $fields = [];
        $values = [];

        foreach($params as $field => $value) {
            $fields[] = "$field = ?";
            $values[] = $value;
        }

        $fieldsList = implode(', ', $fields);
        $result = $this->request('UPDATE `photo` SET '.$fieldsList. 'WHERE id='.$idPhoto, $valeurs);

        return $result;
    }

    public function findPhotoBy(array $params) {
        $fields = [];
        $values = [];
        
        foreach($criteria as $field => $value){
            $fields[] = "$field = ?";
            $values[] = $value;
        }
        // transforms fields array into a string
        $fieldsList = implode(' AND ', $fields);

        $result = $this->request('SELECT * FROM `photo` WHERE '.$fieldsList, $values)->fetchAll();
        return $result;
    }


    public function deletePhoto(int $idPhoto) {
        $result = $this->request('DELETE FROM `photo` WHERE id='.$idPhoto);

        return $result;
    }
}