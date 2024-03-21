<?php

namespace app\models;

use UserModel;
use DbConnector;

class AuthentificationModel extends mainModel{
    
    public function login(string $email, string $mdp){
        if(!isset($_SESSION)) {
            session_start();
        }
        if (DbConnector::getInstance() !== false) {
            $util = $this->findUserBy(array ($email=>$this->email));
            $pwDb = $util['password'];

            if (password_verify(trim($pw), trim($pwDb))) {
                $_SESSION['email'] = $email;
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
            $util = $this->findUserBy(array($email=>$_SESSION["email"]));
            if ($util["email"] == $_SESSION["email"] && $util["password"] == $_SESSION["password"])
            {
                return true;
            }
        }
    }
}