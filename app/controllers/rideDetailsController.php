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
        $params = ['idUser' => $ride->idUser];
        $pseudo = $this->getCreatorPseudo($ride, $params);
        
        $participants = new ParticipantModel;
        // get the number of participants
        $partQuantity = $participants->getParticipantsNumber($ride->idBalade);

        // get the id of all participants 
        $partList = $participants->getParticipantsList($ride->idBalade);

        // verify if the user is already participating to this ride
        if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
        $participation = $participants->getParticipation($ride->idBalade, $_SESSION['user']['idUser']);
        }
        
        $title= $ride->title.' - Ride Connect';
        include ROOT.'/app/views/rideDetails.php';
    }

    // method to add a participant to the ride
    public function addParticipant() {
        $rideModel = new RideModel;
        // get the ride's id in url
        $ride = $this->getRide('participer', 3);

        // this ride doesn't exist
        if (!$ride) {
            $_SESSION['error'] = "Cette balade n'existe pas !";
            $title = 'Profil - Ride Connect';
            include ROOT .'/app/views/profile.php';
        }


        $participant = new ParticipantModel;

        $result = $participant->createParticipant(['idUser'=>$_SESSION['user']['idUser'], 'idBalade'=>$ride->idBalade]);
        
        if (isset($result)) {
            if($result) {
                $_SESSION['message'] = "Vous êtes bien inscrit à cette balade !";
                $title = $ride->title.' - Ride Connect';
                header('Location: '.BASE_URL.'/ride-connect/profil');
            }
            else {
                $_SESSION['message'] = "Une erreur est survenue. Veuillez réessayer plus tard.";
                $title = $ride->title.' - Ride Connect';
                include ROOT.'/app/views/rideDetails.php';
            }
        }
    }
    
    // remove user's participation
    public function removeParticipant() {
        $rideModel = new RideModel;
        // get the ride's id in url
        $ride = $this->getRide('desinscrire', 3);

        // this ride doesn't exist
        if (!$ride) {
            $_SESSION['error'] = "Cette balade n'existe pas !";
            $title = 'Profil - Ride Connect';
            include ROOT .'/app/views/profile.php';
        }

        $participant = new ParticipantModel;

        $result = $participant->deleteParticipant(['idUser'=>$_SESSION['user']['idUser'], 'idBalade'=>$ride->idBalade]);
        
        if (isset($result)) {
            if($result) {
                $_SESSION['message'] = "Votre inscription à cette balade a bien été annulée !";
                $title = $ride->title.' - Ride Connect';
                header('Location: '.BASE_URL.'/ride-connect/profil');
            }
            else {
                $_SESSION['message'] = "Une erreur est survenue. Veuillez réessayer plus tard.";
                $title = $ride->title.' - Ride Connect';
                include ROOT.'/app/views/rideDetails.php';
            }
        }
    }

    // verify if the user is participating to the ride
     public function verifyParticipation($idBalade, $idUser) {
        $participantModel = new ParticipantModel;
        $result = $participantModel->getParticipation($idBalade, $idUser);
        return $result;
     } 
}