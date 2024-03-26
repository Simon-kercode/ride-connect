<?php

namespace app\controllers;

class HomeController {
    public function index() {
        include ROOT . "/app/views/header.php";
        include ROOT . "/app/views/home.php";
        include ROOT . "/app/views/footer.php";
    }
}


?>