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

        foreach($rides as $ride) {
            $params = ['balade.idUser' => $ride->idUser];
            $pseudo = $this->getCreatorPseudo($ride, $params);
        }

        $subscribedRides = $this->getMySubscribedRides();

        foreach($subscribedRides as $subscribedRide) {
            $params = ['balade.idUser' => $subscribedRide->idUser];
            $pseudo = $this->getCreatorPseudo($subscribedRide, $params);
        }

        include 'app/views/profile.php';
    }
    
    private function getMyRides() {
        $rideModel = new RideModel;
        $columns = ['idUser', 'idBalade', 'title', 'department', 'date', 'length', 'duration', 'difficulty', 'meetingPoint'];
        $rides = $this->findAndOrder($columns, $params = ['idUser'=>$_SESSION['user']['idUser']], "", 'date', 'ASC');
        return $rides;
    }

    private function getMySubscribedRides() {
        $rideModel = new RideModel;
        // SELECT title FROM balade JOIN participate on balade.idBalade = participate.idBalade WHERE participate.iduser=13 ORDER BY date DESC;
        $columns = ['balade.idUser', 'balade.idBalade', 'title', 'department', 'date', 'length', 'duration', 'difficulty', 'meetingPoint'];
        $joinParams = [['table' => 'participate', 'condition' => 'balade.idBalade = participate.idBalade']];
        $params = ['participate.idUser' => $_SESSION['user']['idUser']];
        $order = 'date';
        $way = 'ASC';
        $subscribedRides = $this->findSomeWithJoinAndOrder($columns, $joinParams, $params, $order, $way);
        
        return $subscribedRides;
    }

    public function rideDelete() {
        $rideModel = new RideModel;
        $ride = $rideModel->getRide('supprimer', 4);

        $participantModel = new ParticipantModel;
        $participants = $participantModel->deleteAllParticipants($ride->idBalade);

        $result = $rideModel->delete('idBalade', $ride->idBalade);
        
        if (isset($result)) {
            if($result) {
                $_SESSION['message'] = "La balade a bien été supprimée.";
                $title = 'Profil - Ride Connect';
                header('Location: /ride-connect/profil');
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

    public function updateInfos() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userModel = new UserModel;
            $user = $userModel->findOneByMail($_SESSION['user']['email']);
            if (isset($_POST['profileEmail']) && !empty($_POST['profileEmail']))  {
                if(preg_match('/^[\p{L}\p{N}.!#$%&\'*+\/=?^_`{|}~-]+@[\p{L}\p{N}-]+(\.[\p{L}\p{N}-]+)*(\.[\p{L}]{2,})$/u', $_POST['profileEmail'])) {
                    $newEmail = htmlspecialchars($_POST['profileEmail']);
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
                    $mailError = "Cette adresse email n'est pas valide.";
                    $title = 'Profil - Ride Connect';
                    include ROOT.'/app/views/profile.php';
                    exit;
                }
            }
            if (isset($_POST['profilePseudo']) && !empty($_POST['profilePseudo'])) {
                $newPseudo = htmlspecialchars($_POST['profilePseudo']);
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
                    if (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\s])\S{8,}$/", $oldPassword) &&
                    preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\s])\S{8,}$/", $newPassword) &&
                    preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\s])\S{8,}$/", $newPasswordConfirm)) {
                        $oldPasswordDb = $user->password;
                        if (password_verify(trim($oldPassword), trim($oldPasswordDb))) {
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
                    header('Location: profil');
                    exit;
                }
                else {
                    // error in database connection
                    $_SESSION['message'] = "Une erreur s'est produite lors de la modification de vos informations. Veuillez réessayer plus tard.";
                    $title = 'Profil - Ride Connect';
                    include ROOT.'/app/views/profile.php';
                    exit;
                }
            }
        }
    }

    public function accountDelete($idUser) {
        $userModel = new UserModel;
        $result = $userModel->delete('idUser', $_SESSION['user']['idUser']);
        session_destroy();
        if(isset($result)) {
            if($result) {
                $_SESSION['message'] = "Compte supprimé avec succès ! Au revoir.";
                $title = 'Ride Connect';
                header('Location: /ride-connect/accueil');
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