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
        $pseudos = [];

        foreach($rides as $ride) {
            $params = ['_user.idUser' => $ride->idUser];
            $pseudo = $this->getCreatorPseudo($ride, $params);
            $pseudos[] = $pseudo;
        }

        $title = 'Administration - Ride Connect';
        include ROOT.'/app/views/admin.php';
    }

    // get all users
    public function findAllUsers() {
        $user = new UserModel;
        return $user->findAll();
    }

    // get all rides
    public function findAllRides() {
        $ride = new RideModel;
        $columns = ['idUser', 'idBalade', 'title', 'department', 'date', 'length', 'duration', 'difficulty', 'meetingPoint'];
        $rides = $ride->findAndOrder($columns, $params = [], "", 'date', 'ASC');
        return $rides;
    }

    // get all messages
    public function findAllMessages() {
        $message = new MessageModel;
        return $message->findAll();
    }

    // make user an admin
    public function setAdmin() {
        $userModel = new UserModel;
        // get idUser in url
        $user = $userModel->findOneByUrl(5);

        if (!$user) {
            $_SESSION['error'] = "Cet utilisateur n'existe pas.";
            $title = 'Profil - Ride Connect';
            header('Location: '.BASE_URL.'/ride-connect/administration');
            exit;
        }
        $userModel->setIsAdmin(1);
        $result = $userModel->update('idUser', $user->idUser);

        if (isset($result)) {
            if($result) {
                $_SESSION['message'] = "L'utilisateur a bien été mis à jour.";
                $title = 'Profil - Ride Connect';
                header('Location: '.BASE_URL.'/ride-connect/administration');
                exit;
            }
        }
        else {
            $_SESSION['error'] = "Une erreur est survenue. Veuillez réessayer plus tard.";
            $title = 'Profil - Ride Connect';
            include ROOT.'/app/views/admin.php';
            exit;
        }
    }

    // revoke admin role of a user
    public function revokeAdmin() {
        $userModel = new UserModel;
        $user = $userModel->findOneByUrl(5);

        if (!$user) {
            $_SESSION['error'] = "Cet utilisateur n'existe pas.";
            $title = 'Profil - Ride Connect';
            header('Location: '.BASE_URL.'/ride-connect/administration');
            exit;
        }
        $userModel->setIsAdmin(0);
        $result = $userModel->update('idUser', $user->idUser);

        if (isset($result)) {
            if($result) {
                $_SESSION['message'] = "L'utilisateur a bien été mis à jour.";
                $title = 'Profil - Ride Connect';
                header('Location: '.BASE_URL.'/ride-connect/administration');
                exit;
            }
        }
        else {
            $_SESSION['error'] = "Une erreur est survenue. Veuillez réessayer plus tard.";
            $title = 'Profil - Ride Connect';
            include ROOT.'/app/views/admin.php';
            exit;
        }
    }

    // delete a ride
    public function rideDelete() {
        $rideModel = new RideModel;
        // get ride's id in url
        $ride = $rideModel->getRide('supprimer', 5);

        if(!$ride) {
            $_SESSION['error'] = "Cette balade n'existe pas.";
            $title = 'Profil - Ride Connect';
            header('Location: '.BASE_URL.'/ride-connect/administration');
            exit;
        }
        $participantModel = new ParticipantModel;
        $participants = $participantModel->deleteAllParticipants($ride->idBalade);

        $result = $rideModel->delete($ride->idBalade, 'idBalade');
        
        if (isset($result)) {
            if($result) {
                $_SESSION['error'] = "La balade a bien été supprimée.";
                $title = 'Profil - Ride Connect';
                header('Location: '.BASE_URL.'/ride-connect/administration');
                exit;
            }
        }
        else {
            $_SESSION['error'] = "Une erreur est survenue. Veuillez réessayer plus tard.";
            $title = 'Profil - Ride Connect';
            include ROOT.'/app/views/admin.php';
            exit;
        }
    }

    // delete a user
    public function userDelete() {
        $userModel = new UserModel;
        // get user's id in url
        $user = $userModel->findOneByURL(5);
        if (!$user) {
            $_SESSION['error'] = "Cet utilisateur n'existe pas.";
            $title = 'Profil - Ride Connect';
            header('Location: '.BASE_URL.'/ride-connect/administration');
            exit;
        }

        $result = $userModel->delete($user->idUser, 'idUser');

        if (isset($result)) {
            if($result) {
                $_SESSION['message'] = "L'utilisateur a bien été supprimée.";
                $title = 'Profil - Ride Connect';
                header('Location: '.BASE_URL.'/ride-connect/administration');
                exit;
            }
        }
        else {
            $_SESSION['error'] = "Une erreur est survenue. Veuillez réessayer plus tard.";
            $title = 'Profil - Ride Connect';
            include ROOT.'/app/views/admin.php';
            exit;
        }
    }
}