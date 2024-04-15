<?php
namespace app\controllers;

use app\models\model;
use app\models\rideModel;
use app\models\userModel;
use app\models\participantModel;

class ProfileController extends RideModel {

    public function index() {

        $title = 'Profil - Ride Connect';
        $rides = $this->getMyRides();
        $ridesPseudos = [];
        foreach($rides as $ride) {
            $params = ['_user.idUser' => $ride->idUser];
            $pseudo = $this->getCreatorPseudo($ride, $params);
            $ridesPseudos[] = $pseudo;
        }

        $subscribedRides = $this->getMySubscribedRides();
        $subscribedRidesPseudos = [];
        foreach($subscribedRides as $subscribedRide) {
            $params = ['_user.idUser' => $subscribedRide->idUser];
            $pseudo = $this->getCreatorPseudo($subscribedRide, $params);
            $subscribedRidesPseudos[] = $pseudo;
        }

        include 'app/views/profile.php';
    }
    
    // get rides created by the user
    private function getMyRides() {
        $rideModel = new RideModel;
        $columns = ['idUser', 'idBalade', 'title', 'department', 'date', 'length', 'duration', 'difficulty', 'meetingPoint'];
        $rides = $this->findAndOrder($columns, $params = ['idUser'=>$_SESSION['user']['idUser']], "", 'date', 'ASC');
        return $rides;
    }

    // get user's subscribed rides
    private function getMySubscribedRides() {
        $rideModel = new RideModel;
        // SELECT 'columns'
        $columns = ['balade.idUser', 'balade.idBalade', 'title', 'department', 'date', 'length', 'duration', 'difficulty', 'meetingPoint'];
        // JOIN 'table' ON 'condition'
        $joinParams = [['table' => 'participate', 'condition' => 'balade.idBalade = participate.idBalade']];
        // WHERE 'params'
        $params = ['participate.idUser' => $_SESSION['user']['idUser']];
        // ORDER BY 'order'
        $order = 'date';
        $way = 'ASC';
        $subscribedRides = $this->findSomeWithJoinAndOrder($columns, $joinParams, $params, $order, $way);
        
        return $subscribedRides;
    }

    // deleting a ride
    public function rideDelete() {
        $rideModel = new RideModel;
        // get ride's id in url
        $ride = $rideModel->getRide('supprimer', 4);

        $participantModel = new ParticipantModel;
        // delete all participants for this ride
        $participants = $participantModel->deleteAllParticipants($ride->idBalade);
        // delete the ride
        $result = $rideModel->delete($ride->idBalade, 'idBalade');
        
        if (isset($result)) {
            if($result) {
                $_SESSION['message'] = "La balade a bien été supprimée.";
                $title = 'Profil - Ride Connect';
                header('Location: '.BASE_URL.'/ride-connect/profil');
                exit;
            }
        }
        else {
            $_SESSION['message'] = "Une erreur est survenue. Veuillez réessayer plus tard.";
            $title = 'Profil - Ride Connect';
            include ROOT.'/app/views/profile.php';
            exit;
        }
    }

    // update user's personnal informations
    public function updateInfos() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userModel = new UserModel;
            $user = $userModel->findOneByMail($_SESSION['user']['email']);
            if (isset($_POST['profileEmail']) && !empty($_POST['profileEmail']))  {
                // verifying email conformity
                if(preg_match('/^[\p{L}\p{N}.!#$%&\'*+\/=?^_`{|}~-]+@[\p{L}\p{N}-]+(\.[\p{L}\p{N}-]+)*(\.[\p{L}]{2,})$/u', $_POST['profileEmail'])) {
                    $newEmail = htmlspecialchars($_POST['profileEmail']);
                    // verify if newEmail doesn't exist
                    if ($userModel->verifyExistingMail($newEmail) === false) {
                        $mailError = "Cette adresse email existe déjà.";
                        $title = 'Profil - Ride Connect';
                        include ROOT.'/app/views/profile.php';
                        exit;
                    }
                    elseif ($newEmail !== $_SESSION['user']['email']) {
                        $setNewEmail = $userModel->setEmail($newEmail); 
                    }
                }
                else {
                    // invalid email format
                    $mailError = "Cette adresse email n'est pas valide.";
                    $title = 'Profil - Ride Connect';
                    include ROOT.'/app/views/profile.php';
                    exit;
                }
            }
            if (isset($_POST['profilePseudo']) && !empty($_POST['profilePseudo'])) {
                $newPseudo = htmlspecialchars($_POST['profilePseudo']);
                // verify if newPseudo doesn't exist
                if($userModel->verifyExistingPseudo($newPseudo) === false) {
                    $pseudoError = "Ce pseudo est déjà utilisé. Veuillez en choisir un autre.";
                    $title = 'Profil - Ride Connect';
                    include ROOT.'/app/views/profile.php';
                    exit;
                }
                elseif ($newPseudo !== $_SESSION['user']['pseudo']) {
                    $setNewPseudo = $userModel->setPseudo($newPseudo);
                }
            }
            if (isset($_POST['profileName']) && !empty($_POST['profileName'])) {
                $newName = htmlspecialchars($_POST['profileName']);
                if ($newName !== $_SESSION['user']['name']) {
                    $setNewName = $userModel->setName($newName);
                }
            }
            if (isset($_POST['profileFirstname']) && !empty($_POST['profileFirstname'])) {
                $newFirstname = htmlspecialchars($_POST['profileFirstname']);
                if ($newFirstname !== $_SESSION['user']['firstname']) {
                    $setNewFirstname = $userModel->setFirstname($newFirstname);
                }
            }
            if ((isset($_POST['newPassword']) && !empty($_POST['newPassword'])) || (isset($_POST['newPasswordConfirm']) && !empty($_POST['newPasswordConfirm']))) {
                if (isset($_POST['oldPassword'], $_POST['newPassword'],$_POST['newPasswordConfirm']) && !empty($_POST['oldPassword']) && !empty($_POST['newPassword']) && !empty($_POST['newPasswordConfirm'])) {
                    $oldPassword = $_POST['oldPassword'];
                    $newPassword = $_POST['newPassword'];
                    $newPasswordConfirm = $_POST['newPasswordConfirm'];
                    // verify conformity of the new password
                    if (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\s])\S{8,}$/", $oldPassword) &&
                    preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\s])\S{8,}$/", $newPassword) &&
                    preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\s])\S{8,}$/", $newPasswordConfirm)) {
                        $oldPasswordDb = $user->password;
                        // verify the user's old password
                        if (password_verify(trim($oldPassword), trim($oldPasswordDb))) {
                            // verify if the matching between the 2 new password fields
                            if ($newPassword === $newPasswordConfirm) {
                               $setNewPassword = $userModel->setPassword(password_hash($newPassword, PASSWORD_DEFAULT));
                            }
                            else {
                                $passwordError = "Les deux mots de passe ne correspondent pas.";
                                $title = 'Profil - Ride Connect';
                                include ROOT.'/app/views/profile.php';
                                exit;
                            }
                        }
                        else {
                            $passwordError = "Mot de passe incorrect.";
                            $title = 'Profil - Ride Connect';
                            include ROOT.'/app/views/profile.php';
                            exit;
                        }
                    }
                    else {
                        $passwordError = "Le mot de passe doit contenir au moins 8 caractères comprenant une minuscule, une majuscule, un chiffre et un caractère spécial.";
                        $title = 'Profil - Ride Connect';
                        include ROOT.'/app/views/profile.php';
                        exit;
                    }
                }
                else {
                    $passwordError = "Merci de remplir les 3 champs pour mettre à jour le mot de passe.";
                    $title = 'Profil - Ride Connect';
                    include ROOT.'/app/views/profile.php';
                    exit;
                }
            }
            // if at least on modification has been done, update user's informations
            if (isset($setNewEmail) || isset($setNewPseudo) || isset($setNewName) || isset($setNewFirstname) || isset($setNewPassword)) {
                $result = $userModel->update('idUser', $user->idUser);
            }
            else {
                $_SESSION['message'] = "Aucune modification n'a été apportée.";
                $title = 'Profil - Ride Connect';
                include ROOT.'/app/views/profile.php';
                exit;
            }

            if (isset($result)) {
                if($result) {
                    // account updated successfully
                    $_SESSION['message'] = "Vos informations ont bien été modifiées";
                    if (isset($newEmail)) {
                        $_SESSION['user']['email'] = $newEmail;
                    }
                    if (isset($newPseudo)) {
                        $_SESSION['user']['pseudo'] = $newPseudo;
                    }
                    if (isset($newName)) {
                        $_SESSION['user']['name'] = $newName;
                    }
                    if (isset($newFirstname)) {
                        $_SESSION['user']['firstname'] = $newFirstname;
                    }
                    header('Location: '.BASE_URL.'/ride-connect/profil');
                    exit;
                }
                else {
                    $_SESSION['message'] = "Une erreur s'est produite lors de la modification de vos informations. Veuillez réessayer plus tard.";
                    $title = 'Profil - Ride Connect';
                    include ROOT.'/app/views/profile.php';
                    exit;
                }
            }
        }
    }

    // delete user's account
    public function accountDelete($idUser) {
        $userModel = new UserModel;
        $result = $userModel->delete($_SESSION['user']['idUser'], 'idUser');
        session_destroy();
        if(isset($result)) {
            if($result) {
                $_SESSION['message'] = "Compte supprimé avec succès ! Au revoir.";
                $title = 'Ride Connect';
                header('Location: '.BASE_URL.'/ride-connect/accueil');
                exit;
            }
            else {
                $_SESSION['message'] = "Une erreur s'est produit lors de la suppression de votre compte. Veuillez réessayer plus tard.";
                $title = 'Profil - Ride Connect';
                include ROOT.'/app/views/profile.php';
                exit;
            }
        }

    }
}