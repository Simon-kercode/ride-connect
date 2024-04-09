<?php
namespace app\controllers;

use app\models\rideModel;
use app\models\model;
use app\models\participantModel;

class RideDetailsController extends RideModel{

    public function index() {
        
        $rideModel = new RideModel;
        // get ride's attributes
        $ride = $this->getRide('', 3);

        // get ride's creator
        $params = ['idBalade' => $ride->idBalade];
        $pseudo = $this->getCreatorPseudo($ride, $params);
        
        $participants = new ParticipantModel;
        // get the number of participants
        $partQuantity = $participants->getParticipantsNumber($ride->idBalade);

        // get the id of all participants 
        $partList = $participants->getParticipantsList($ride->idBalade);

        if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
        $participation = $participants->getParticipation($ride->idBalade, $_SESSION['user']['idUser']);
        }
        
        $title= $ride->title.' - Ride Connect';
        include ROOT.'/app/views/rideDetails.php';
    }

    public function addParticipant() {
        $rideModel = new RideModel;
        $ride = $this->getRide('', 3);

        $participantModel = new ParticipantModel;
        
        $result = $participantModel->createParticipant(['idUser'=>$_SESSION['user']['idUser'], 'idBalade'=>$ride->idBalade]);
        
        if (isset($result)) {
            if($result) {
                $_SESSION['message'] = "Vous êtes bien inscrit à cette balade ! Retrouvez y les détails sur votre profil.";
                $title = $ride->title.' - Ride Connect';
                header('Location: /ride-connect/balades/'.$ride->idBalade);
            }
            else {
                $_SESSION['message'] = "Une erreur est survenue. Veuillez réessayer plus tard.";
                $title = $ride->title.' - Ride Connect';
                include ROOT.'/app/views/rideDetails.php';
            }
        }
    }
     public function verifyParticipation($idBalade, $idUser) {
        $participantModel = new ParticipantModel;
        $result = $participantModel->getParticipation($idBalade, $idUser);
        return $result;
     } 
}