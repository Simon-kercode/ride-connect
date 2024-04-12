<?php

namespace app\controllers;

use app\models\userModel;
use app\models\model;

class UserController {
    
    public function index() {
        $title = 'Connexion - Ride Connect';
        include ROOT.'/app/views/login.php';
    }
    
    public function userLogin(){

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['email'], $_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {
                if(preg_match('/^[\p{L}\p{N}.!#$%&\'*+\/=?^_`{|}~-]+@[\p{L}\p{N}-]+(\.[\p{L}\p{N}-]+)*(\.[\p{L}]{2,})$/u', $_POST['email'])) {

                    $email = htmlspecialchars($_POST['email']);
                    $password = htmlspecialchars($_POST['password']);

                    $user = new UserModel();
                    
                    $result = $user->login($email, $password);
                    
                    if ($result == true) {
                        header('Location: '.$_SERVER['HTTP_ORIGIN'].'/ride-connect/profil');
                        exit;
                    }
                    elseif ($result == false) {
                        $error = "Identifiants incorrects";
                        $title = 'Connexion - Ride Connect';
                        include ROOT.'/app/views/login.php';
                        exit;
                    }
                    else {
                        if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
                        $error = $_SESSION['error'];
                        $title = 'Connexion - Ride Connect';
                        include ROOT.'/app/views/login.php';
                        exit;
                        }
                    }
                }
                else {
                    $error = "Identifiants incorrects";
                    $title = 'Connexion - Ride Connect';
                    include ROOT.'/app/views/login.php';
                    exit;
                }    
            }
            else $error = "Veuillez remplir tous les champs";
            $title = 'Connexion - Ride Connect';
            include ROOT.'/app/views/login.php';
            exit;
        }
    }

    public function userLogout() {
        $userLogout = new UserModel();
        $userLogout->logout();
        header('Location: accueil');
    }
}