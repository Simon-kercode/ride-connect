<?php

namespace app\controllers;

use app\models\userModel;
use app\models\model;

class UserController {
    
    public function index() {
        $titre = 'Connexion - Ride Connect';
        include ROOT.'/app/views/login.php';
    }
    
    public function userLogin(){

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['email'], $_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {
                $email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['password']);

                $user = new UserModel();
                
                $result = $user->login($email, $password);
                
                if ($result == true) {
                    $_SESSION['message'] = "Vous êtes connecté en tant que ".$_SESSION['user']['pseudo'];
                    include ROOT.'/app/views/login.php';
                    exit;
                }
                else if ($result == false) {
                    $_SESSION['error'] = "Identifiants incorrects";
                }
            }
            else $_SESSION['error'] = "Veuillez remplir tous les champs";
        }
    }

    public function userLogout() {
        $userLogout = new UserModel;
        $userLogout->logout();
        header('Location: accueil');
    }
}