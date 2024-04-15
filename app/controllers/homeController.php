<?php

namespace app\controllers;

use app\controllers\ridesController;

class HomeController extends RidesController {
    public function index() {
        $ridesController = new RidesController;
        // find next 4 rides
        $rides = $ridesController->makeRidesList();
        $pseudos = [];
        for ($i=0; $i <= 3; $i++) { 
            if(isset($rides[$i]) && !empty($rides[$i])) {
            $params = ['_user.idUser' => $rides[$i]->idUser];
            $pseudo = $ridesController->getCreatorPseudo($rides[$i], $params);
            $pseudos[] = $pseudo;
            }
        }

        $title = "Ride Connect - Balades moto collaboratives";
        include ROOT . "/app/views/home.php";
    }

}


?>