<?php

namespace app\controllers;

class controller404 {

    public function index() {
        $titre = '404 - Ride Connect';
        include ROOT.'/app/views/404.php';
    }
}