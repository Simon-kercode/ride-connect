<?php

namespace app\controllers;
use app\models\userModel;

class LogoutController {

    public function userLogout() {
        $userLogout = new UserModel;
        $userLogout->logout();
        header('Location: accueil');
    }
}