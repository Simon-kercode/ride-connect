<?php 
namespace app\controllers;

use app\models\rideModel;
use app\models\model;

class OrgaController {
    
    public function index() {

        $title = 'Organiser ma balade - Ride Connect';
        include ROOT.'/app/views/orga.php';
    }
}