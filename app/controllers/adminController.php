<?php
namespace app\controllers;

class AdminController {
    
    public function index() {
        $title = 'Administration - Ride Connect';
        include ROOT.'/app/views/admin.php';
    }
}