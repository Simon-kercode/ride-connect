<?php

namespace app\controllers;

class HomeController {
    public function index() {
        $title = "Ride Connect - Balades moto collaboratives";
        include ROOT . "/app/views/home.php";
    }
}


?>