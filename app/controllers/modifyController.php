<?php 
namespace app\controllers;

use app\models\rideModel;

class ModifyController extends RideModel {

    public function index() {

        $ride = $this->getRide('modifier', 3);
        $title= $ride->title.' - Ride Connect';
        include ROOT.'/app/views/modify.php';
    }

    public function updateRide() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset ($_POST['title'], $_POST['date'], $_POST['time'], $_POST['startPoint'], $_POST['meetingPoint'], $_POST['partNumber'], $_POST['difficulty'], $_POST['pointsInfos'], $_POST['routeInfos'], $_POST['waypoints'], $_POST['precisions']) &&
             !empty($_POST['title']) && !empty($_POST['date']) && !empty($_POST['time']) && !empty($_POST['startPoint']) && !empty($_POST['meetingPoint']) && !empty($_POST['difficulty']) && !empty($_POST['pointsInfos']) && !empty($_POST['routeInfos']) && !empty($_POST['waypoints'])) {

                $ride = new RideModel;
                $initialRide = $ride->getRide('modifier', 3);

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
                // $map = null;
                $waypoints = $_POST['waypoints'];
                $idUser = $_SESSION['user']['idUser'];

                    if ($title !== $initialRide->title) {
                        $ride->setTitle($title);
                    }
                    if ($date !== $initialRide->date) {
                        $ride->setDate($date);
                    }
                    if ($time !== $initialRide->time) {
                        $ride->setTime($time);
                    }
                    if ($length !== $initialRide->length) {
                        $ride->setLength($length);
                    }
                    if ($duration !== $initialRide->duration) {
                        $ride->setDuration($duration);
                    }
                    if ($difficulty !== $initialRide->difficulty) {
                        $ride->setDifficulty($difficulty);
                    }
                    if ($partNumber !== $initialRide->partNumber) {
                        $ride->setPartNumber($partNumber);
                    }
                    if ($startPoint !== $initialRide->startPoint) {
                        $ride->setStartPoint($startPoint);
                    }
                    if ($arrival !== $initialRide->arrival) {
                        $ride->setArrival($arrival);
                    }
                    if ($department !== $initialRide->department) {
                        $ride->setDepartment($department);
                    }
                    if ($region !== $initialRide->region) {
                        $ride->setRegion($region);
                    }
                    if ($meetingPoint !== $initialRide->meetingPoint) {
                        $ride->setmeetingPoint($meetingPoint);
                    }
                    if ($precisions !== $initialRide->precisions) {
                        $ride->setPrecisions($precisions);
                    }
                    if ($waypoints !== $initialRide->waypoints) {
                        $ride->setWaypoints($waypoints);
                    }
                    $result = $ride->update('idBalade', $initialRide->idBalade);

                    if (isset($result)) {
                        
                        if ($result) {
                            $title = 'Profil - Ride Connect';
                            $_SESSION['message'] = "Ta balade a bien été modifiée !";
                            header("Location: ".$_SERVER['HTTP_ORIGIN']."/ride-connect/profil");
                            exit;
                        }
                        else {
                            $ride = $this->getRide('modifier', 3);
                            $title = $ride->title.' - Ride Connect';
                            $error = "Une erreur est survenue. Merci de réessayer plus tard.";
                            include ROOT.'/app/views/modify.php';
                            exit;
                        }
                    }
                    else {
                        $ride = $this->getRide('modifier', 3);
                        $error = "Une erreur est survenue. Merci de réessayer plus tard.";
                        $title = $ride->title.' - Ride Connect';
                        include ROOT.'/app/views/modify.php';
                        exit;
                    }
            }
            else {
                $ride = $this->getRide('modifier', 3);
                $error = "Veuillez remplir tous les champs requis";
                $title = $ride->title.' - Ride Connect';
                include ROOT.'/app/views/modify.php';
            }

        }

    }
}
