<?php

namespace app\controllers;

class confidentialityController {

    public function index() {

        $title = 'Politique de confidentialité';
        include ROOT.'/app/views/confidentialite.php';
    }
}