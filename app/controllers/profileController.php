<?php
namespace app\controllers;

use app\models\model;
use app\models\rideModel;
use app\models\userModel;

class ProfileController extends RideModel {

    public function index() {

        $title = 'Profil - Ride Connect';
        $rides = $this->getMyRides();

        foreach($rides as $ride) {
            $params = ['balade.idUser' => $ride->idUser];
            $pseudo = $this->getCreatorPseudo($ride, $params);
        }

        include 'app/views/profile.php';
    }

    private function getMyRides() {
        $rideModel = new RideModel;
        $columns = ['idUser', 'idBalade', 'title', 'department', 'date', 'length', 'duration', 'difficulty'];
        $rides = $this->findAndOrder($columns, $params = [], "", 'date', 'DESC');
        return $rides;
    }

    private function getMySubscribedRides() {
        $rideModel = new RideModel;
        SELECT title FROM balade JOIN participate on balade.idBalade = participate.idBalade WHERE participate.iduser=13 ORDER BY date DESC; 
    }
}