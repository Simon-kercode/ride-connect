<?php

namespace app\models;

class ParticipantModel extends Model {

    private int $idUser;
    private int $idBalade;

    public function __construct() {
        $this->table = 'participate';
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

    public function getParticipantsNumber(int $idBalade) {
        $result = $this->findBy(['idBalade' => $idBalade]);
        if($result) {
            $participants = count($result);
            return $participants;
        }
        else return 0;
    }
}