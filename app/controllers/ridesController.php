<?php 
namespace app\controllers;

use app\models\rideModel;

class RidesController extends RideModel {
    
    public function index() {
        $title = 'Balades - Ride Connect';
        $rides = $this->makeRidesList();
        
        foreach($rides as $ride) {
            $params = ['balade.idUser' => $ride->idUser];
            $pseudo = $this->getCreatorPseudo($ride, $params);
        }
        include ROOT.'/app/views/rides.php';
    }

    /* constructs the ride list depending on the user research
    * DEFAULT : display the list of all rides
    */
    public function makeRidesList() {

        $rideModel = new RideModel;
        $columns = ['idUser', 'idBalade', 'title', 'department', 'date', 'length', 'duration', 'difficulty'];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['rideSearch']) && !empty($_POST['rideSearch'])) {
                $rides = $this->findAndOrder($columns, ['region' => $_POST['rideSearch'], 'department' => $_POST['rideSearch']], 'OR', 'date', 'ASC');
            }
            elseif (isset($_POST['rideSearch']) && empty($_POST['rideSearch'])) {
                $_SESSION['message'] = "Veuillez renseigner un département ou une région.";
                $rides = $this->findAndOrder($columns, $params = [], "", 'date', 'ASC');
            }
        }
        // DEFAULT
        else {
            $rides = $this->findAndOrder($columns, $params = [], "", 'date', 'ASC');
        }
        return $rides;
    }

}