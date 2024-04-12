<?php
namespace app\controllers;

use app\models\model;
use app\models\userModel;
use app\models\rideModel;
use app\models\participantModel;
use app\models\messageModel;

class AdminController extends RideModel{
    
    public function index() {
        $users = $this->findAllUsers();
        $rides = $this->findAllRides();
        $messages = $this->findAllMessages();

        foreach($rides as $ride) {
            $params = ['balade.idUser' => $ride->idUser];
            $pseudo = $this->getCreatorPseudo($ride, $params);
        }

        $title = 'Administration - Ride Connect';
        include ROOT.'/app/views/admin.php';
    }

    public function findAllUsers() {
        $user = new UserModel;
        return $user->findAll();
    }

    public function findAllRides() {
        $ride = new RideModel;
        $columns = ['idUser', 'idBalade', 'title', 'department', 'date', 'length', 'duration', 'difficulty', 'meetingPoint'];
        $rides = $ride->findAndOrder($columns, $params = [], "", 'date', 'ASC');
        return $rides;
    }

    public function findAllMessages() {
        $message = new MessageModel;
        return $message->findAll();
    }

    

    public function rideDelete() {
        $rideModel = new RideModel;
        $ride = $rideModel->getRide('supprimer', 5);

        if(!$ride) {
            $_SESSION['message'] = "Cette balade n'existe pas.";
            $title = 'Profil - Ride Connect';
            header('Location: '.$_SERVER['HTTP_ORIGIN'].'/ride-connect/administration');
            exit;
        }
        $participantModel = new ParticipantModel;
        $participants = $participantModel->deleteAllParticipants($ride->idBalade);

        $result = $rideModel->delete($ride->idBalade, 'idBalade');
        
        if (isset($result)) {
            if($result) {
                $_SESSION['message'] = "La balade a bien été supprimée.";
                $title = 'Profil - Ride Connect';
                header('Location: '.$_SERVER['HTTP_ORIGIN'].'/ride-connect/administration');
                exit;
            }
        }
        else {
            $_SESSION['message'] = "Une erreur est survenue. Veuillez réessayer plus tard.";
            $title = 'Profil - Ride Connect';
            include ROOT.'/app/views/admin.php';
            exit;
        }
    }

    public function userDelete() {
        $userModel = new UserModel;
        $user = $userModel->findOneByURL(5);
        if (!$user) {
            $_SESSION['message'] = "Cet utilisateur n'existe pas.";
            $title = 'Profil - Ride Connect';
            header('Location: '.$_SERVER['HTTP_ORIGIN'].'/ride-connect/administration');
            exit;
        }

        $result = $userModel->delete($user->idUser, 'idUser');

        if (isset($result)) {
            if($result) {
                $_SESSION['message'] = "L'utilisateur a bien été supprimée.";
                $title = 'Profil - Ride Connect';
                header('Location: '.$_SERVER['HTTP_ORIGIN'].'/ride-connect/administration');
                exit;
            }
            
        }
        else {
            $_SESSION['message'] = "Une erreur est survenue. Veuillez réessayer plus tard.";
            $title = 'Profil - Ride Connect';
            include ROOT.'/app/views/admin.php';
            exit;
        }
    }
}