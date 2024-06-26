<?php 
namespace app\controllers;

use app\models\rideModel;
use app\models\participantModel;
use app\models\model;

class OrgaController extends RideModel {
    
    public function index() {

        $title = 'Organiser ma balade - Ride Connect';
        include ROOT.'/app/views/orga.php';
    }

    public function createRide() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset ($_POST['title'], $_POST['date'], $_POST['time'], $_POST['startPoint'], $_POST['meetingPoint'], $_POST['partNumber'], $_POST['difficulty'], $_POST['pointsInfos'], $_POST['routeInfos'], $_POST['waypoints'], $_POST['precisions']) &&
             !empty($_POST['title']) && !empty($_POST['date']) && !empty($_POST['time']) && !empty($_POST['startPoint']) && !empty($_POST['meetingPoint']) && !empty($_POST['difficulty']) && !empty($_POST['pointsInfos']) && !empty($_POST['routeInfos']) && !empty($_POST['waypoints'])) {

                $ride = new RideModel;

                $decodedRouteInfos = json_decode($_POST['routeInfos']);
                $decodedPointsInfos = json_decode($_POST['pointsInfos']);
                

                $title = htmlspecialchars($_POST['title']);
                $date = htmlspecialchars($_POST['date']);
                $time = htmlspecialchars($_POST['time']);
                $length = $decodedRouteInfos->distance;
                $duration = $decodedRouteInfos->duration;
                $difficulty = ($_POST['difficulty']);
                $partNumber = htmlspecialchars($_POST['partNumber']);
                $startPoint = $decodedPointsInfos[0]->city;
                $arrival = end($decodedPointsInfos)->city;
                $department = str_replace('-', ' ', $decodedPointsInfos[0]->department);
                $region = str_replace('-', ' ', $decodedPointsInfos[0]->region);
                $meetingPoint = htmlspecialchars($_POST['meetingPoint']);
                $precisions = htmlspecialchars($_POST['precisions']);
                $waypoints = $_POST['waypoints'];
                $idUser = $_SESSION['user']['idUser'];

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
                    ->setWaypoints($waypoints)
                    ->setIdUser($idUser);
                $result = $ride->create();

                // get the ride's id that has just been created
                $idBalade = $this->getLastId();
                // add a participant to this ride
                $participant = new ParticipantModel($_SESSION['user']['idUser'], $idBalade);
                $storedParticipant = $participant->createParticipant(['idUser' => $_SESSION['user']['idUser'], 'idBalade' => $idBalade]);

                if (isset($result)) {
                        
                    if ($result) {
                        $title = 'Organiser ma balade - Ride Connect';
                        $_SESSION['message'] = "Ta balade a bien été enregistrée !";
                        header('Location: '.BASE_URL.'/ride-connect/profil');
                    }
                    else {
                        $title = 'Organiser ma balade - Ride Connect';
                        $error = "Une erreur est survenue";
                        include ROOT.'/app/views/orga.php';
                        exit;
                    }
                }
                else {
                    $error = "Une erreur est survenue";
                    $title = 'Organiser ma balade - Ride Connect';
                    include ROOT.'/app/views/orga.php';
                    exit;
                }
            }
            else {
                $error = "Veuillez remplir tous les champs requis";
                $title = 'Organiser ma balade - Ride Connect';
                include ROOT.'/app/views/orga.php';
                exit;
            }
        }
    }
}