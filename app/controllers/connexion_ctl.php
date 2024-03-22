<?php

namespace app\controllers;
use app\models\AuthentificationModel;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email'], $_POST['mdp']) && !empty($_POST['email']) && !empty($_POST['mdp'])) {
        $email = $_POST['email'];
        $password = $_POST['mdp'];

        $conn = new AuthentificationModel;
        
        $req = $conn->login($email, $password);
        if ($req == true) {
            echo "Connexion réussie";
        }
        else if ($req == false) {
            echo "Identifiants incorrects";
        }
    }
    else echo "Veuillez remplir tous les champs";
}
