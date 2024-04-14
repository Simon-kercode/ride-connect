<?php

namespace app\controllers;

class LegalNoticesController {

    public function index() {

        $title = "Mentions légales";
        include ROOT.'/app/views/legalNotices.php';
    }
}