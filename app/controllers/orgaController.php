<?php 
namespace app\controllers;

use app\models\rideModel;
use app\models\model;

class OrgaController {
    
    public function index() {

        $title = 'Organiser ma balade - Ride Connect';
        include ROOT.'/app/views/orga.php';
    }

    public function createBalade() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset ($_POST['title'], $_POST['date'], $_POST['time'], $_POST['StartPoint'], $_POST['meetingPoint'], $_POST['partNumber'], $_POST['difficulty'], $_POST['precisions']) &&
             !empty($_POST['title']) && !empty($_POST['date']) && !empty($_POST['time']) && !empty($_POST['StartPoint']) && !empty($_POST['rdv']) && !empty($_POST['difficulty'])) {

                $routeInfos = $this->getData();
                include ROOT.'/app/views/orga.php';
                exit;


            }
            else {
                $error = "Veuillez remplir tous les champs requis";
            }
        }
    }

    private function getData() {

        return json_decode(file_get_contents('php://input'));

    }
    /* Récupération des données : 
    * title, date, time, departure, meetingPoint, partNumber, difficulty, precisions : via formulaire
    * arrival, department, region : nominatim
    * length, duration, waypoints : ORS
    * map : ??? 
    */
}