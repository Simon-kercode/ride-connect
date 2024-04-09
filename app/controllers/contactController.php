<?php
namespace app\controllers;

class ContactController {

    public function index() {

        $titre = 'Contact - Ride Connect';
        include ROOT.'/app/views/contact.php';
    }
}