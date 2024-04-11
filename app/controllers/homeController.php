<?php

namespace app\controllers;

use app\controllers\ridesController;

class HomeController extends RidesController {
    public function index() {
        $ridesController = new RidesController;
        // find next 4 rides
        $rides = $ridesController->makeRidesList();
        for ($i=0; $i < 3; $i++) { 
            if(isset($rides[$i]) && !empty($rides[$i])) {
            $params = ['balade.idUser' => $rides[$i]->idUser];
            $pseudo = $ridesController->getCreatorPseudo($rides[$i], $params);
            }
        }

        $title = "Ride Connect - Balades moto collaboratives";
        include ROOT . "/app/views/home.php";
    }

}


?>