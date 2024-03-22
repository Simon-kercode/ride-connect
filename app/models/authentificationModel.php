<?php

namespace app\models;

use app\models\UserModel;
use app\models\DbConnector;

class AuthentificationModel extends Model{
    private $db;

    public function login(string $email, string $mdp){
        if(!isset($_SESSION)) {
            session_start();
        }
        if ($this->db = DbConnector::getInstance() !== false) {
            $userModel = new UserModel($email, $mdp);
            $util = $userModel->findUserBy(['email'=>$email]);
            var_dump($util);
            $pwDb = $util[2]['password'];
            var_dump($mdp);
            var_dump($pwDb);
            if (password_verify(trim($mdp), trim($pwDb))) {
                $_SESSION['email'] = $email;
                var_dump($_SESSION);
                return true;
            }
            else return false;
        }
        else {
            return null;
        }
    }

    public function logout(){
        if (!isset($_SESSION)) {
            session_start();
        }
        unset($_SESSION["email"]);
    }

    public function isLoggedOn() {
        if (!isset($_SESSION)) {
            session_start();
            return false;
        }
        
        if (isset($_SESSION["email"])) {
            $util = $this->findUserBy([$email=>$_SESSION["email"]]);
            if ($util["email"] == $_SESSION["email"] && $util["password"] == $_SESSION["password"])
            {
                return true;
            }
        }
    }
}