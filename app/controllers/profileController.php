<?php
namespace app\controllers;

class ProfileController {

    public function index() {

        $titre = 'Profil - Ride Connect';
        include 'app/views/profile.php';
    }
}