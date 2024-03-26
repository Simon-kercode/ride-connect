<?php

namespace app\controllers;

use app\models\userModel;
use app\models\model;



class ConnectionController {

    public function connection(){

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['email'], $_POST['mdp']) && !empty($_POST['email']) && !empty($_POST['mdp'])) {
                $email = $_POST['email'];
                $password = $_POST['mdp'];
                var_dump($email);
                var_dump($password);
                $conn = new UserModel();
                
                $req = $conn->login();
                var_dump($req);
                if ($req == true) {
                    echo "Connexion réussie";
                }
                else if ($req == false) {
                    echo "Identifiants incorrects";
                }
            }
            else echo "Veuillez remplir tous les champs";
        }
    }
}
include ROOT . "/app/views/header.php";
include ROOT . "/app/views/connection.php";
include ROOT . "/app/views/footer.php";