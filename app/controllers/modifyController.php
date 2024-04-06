<?php 
namespace app\controllers;

use app\models\rideModel;
use app\controllers\rideDetailsController;

class ModifyController extends RideModel {

    public function index() {
        $rideDetails = new RideDetailsController;
        $ride = $rideDetails->getRide();
        $title= $ride->title.' - Ride Connect';
        include ROOT.'/app/views/modify.php';
    }


}