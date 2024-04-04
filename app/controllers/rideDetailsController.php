<?php
namespace app\controllers;

use app\models\rideModel;
use app\models\model;

class RideDetailsController extends RideModel{

    public function index() {
        $title= 'Details balade - Ride Connect';
        $ride = $this->getRide();
        $params = ['idBalade' => $ride->idBalade];
        $pseudo = $this->getCreatorPseudo($ride, $params);
        var_dump($pseudo);
        
        var_dump($ride->idUser);
        include ROOT.'/app/views/rideDetails.php';
    }

    public function getRide() {
        $url = $_SERVER['REQUEST_URI'];
        $explodeURL = explode('/', $url);
        $id = end($explodeURL);
        if (isset($id) && !empty($id) && ctype_digit($id)) {
            return($this->findOneByOneParam('idBalade', $id));
        }
    }
}