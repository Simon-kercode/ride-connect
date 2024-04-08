<?php
namespace app\controllers;

use app\models\rideModel;
use app\models\model;
use app\models\participantModel;

class RideDetailsController extends RideModel{

    public function index() {
        
        $rideModel = new RideModel;
        // get ride's attributes
        $ride = $this->getRide();

        // get ride's creator
        $params = ['idBalade' => $ride->idBalade];
        $pseudo = $this->getCreatorPseudo($ride, $params);
        
        $participants = new ParticipantModel;
        // get the number of participants
        $partQuantity = $participants->getParticipantsNumber($ride->idBalade);

        // get the id of all participants 
        $partList = $participants->getParticipantsList($ride->idBalade);

        $title= $ride->title.' - Ride Connect';
        include ROOT.'/app/views/rideDetails.php';
    }

    public function addParticipant() {
        $participantModel = new ParticipantModel;
        $result = $participantModel->createParticipant(['idUser'=>$_SESSION['idUser'], 'idBalade'=>$ride->idBalade]);
        
        if (isset($result)) {
            if($result) {
                $_SESSION['message'] = "Vous êtes bien inscrit à cette balade ! Retrouvez y les détails sur votre profil.";
                $title = $ride->title.' - Ride Connect';
                include ROOT.'/app/views/rideDetails.php';
            }
            else {
                $_SESSION['message'] = "Une erreur est survenue. Veuillez réessayer plus tard.";
                $title = $ride->title.' - Ride Connect';
                include ROOT.'/app/views/rideDetails.php';
            }
        }
    }    
}