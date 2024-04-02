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
            if (isset ($_POST['title'], $_POST['date'], $_POST['time'], $_POST['startPoint'], $_POST['meetingPoint'], $_POST['partNumber'], $_POST['difficulty'], $_POST['precisions']) &&
             !empty($_POST['title']) && !empty($_POST['date']) && !empty($_POST['time']) && !empty($_POST['StartPoint']) && !empty($_POST['rdv']) && !empty($_POST['difficulty'])) {

                $rideInfos = $this->getData();
                var_dump($rideInfos);
                

                $ride = new RideModel;

                $title = $_POST['title'];
                $date = $_POST['date'];
                $time = $_POST['time'];
                $length = $rideInfos['routeInfos'].distance;
                $duration = $rideInfos['routeInfos'].duration;
                $difficulty = $_POST['difficulty'];
                $partNumber = $_POST['partNumber'];
                $startPoint = $rideInfos['pointsInfos'][0]['city'];
                $arrival = $rideInfos['pointsInfos'][-1]['city'];
                $department = $rideInfos['pointsInfos'][0]['department'];
                $region = $rideInfos['pointsInfos'][0]['region'];
                $meetingPoint = $_POST['meetingPoint'];
                $precisions = $_POST['precisions'];
                $map = null;
                $waypoints = [];

                $ride->setTitle($title)
                    ->setDate($date)
                    ->setTime($time)
                    ->setLength($length)
                    ->setDuration($duration)
                    ->setDifficulty($difficulty)
                    ->setPartNumber($partNumber)
                    ->setStartPoint($startPoint)
                    ->setArrival($arrival)
                    ->setDepartment($department)
                    ->setRegion($region)
                    ->setMeetingPoint($meetingPoint)
                    ->setPrecisions($precisions)
                    ->setMap($map)
                    ->setWaypoints($waypoints);

                $result->$ride->create();

                if (isset($result)) {
                        
                    if ($result) {
                        $title = 'Organiser ma balade - Ride Connect';
                        $error = "La balade a bien été enregistrée";
                        include ROOT.'/app/views/orga.php';
                    }
                    else {
                        $title = 'Organiser ma balade - Ride Connect';
                        $error = "Une erreur est survenue";
                        include ROOT.'/app/views/orga.php';
                    }

                
            }
            else {
                $error = "Veuillez remplir tous les champs requis";
            }
        }
    }
}
    private function getData() {
        
        $jsonData = file_get_contents('php://input');

        $data= json_decode($jsonData);
        var_dump($data);

    }
    /* Récupération des données : 
    * title, date, time, departure, meetingPoint, partNumber, difficulty, precisions : via formulaire
    * arrival, department, region : nominatim
    * length, duration, waypoints : ORS
    * map : ??? 
    */
}