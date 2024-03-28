<?php 
namespace app\controllers;

use app\models\model;

class RidesController {
    
    public function index() {
        $title = 'Balades - Ride Connect';
        include ROOT.'/app/views/rides.php';
    }
}