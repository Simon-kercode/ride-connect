<?php
namespace app\controllers;

use app\models\rideModel;
use app\models\model;
use app\models\participantModel;

class RideDetailsController extends RideModel{

    public function index() {
        
        $rideModel = new RideModel;
        $ride = $this->getRide();

        $params = ['idBalade' => $ride->idBalade];
        $pseudo = $this->getCreatorPseudo($ride, $params);

        $participants = new ParticipantModel;
        $partQuantity = $participants->getParticipantsNumber($ride->idBalade);

        $title= $ride->title.' - Ride Connect';
        include ROOT.'/app/views/rideDetails.php';
    }

    
}