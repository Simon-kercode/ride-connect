<?php 
namespace app\controllers;

use app\models\model;
use app\models\rideModel;

class RidesController extends RideModel {
    
    public function index() {
        $title = 'Balades - Ride Connect';
        include ROOT.'/app/views/rides.php';
    }

    /* constructs the ride list depending on the user research
    * DEFAULT : display the list of all rides
    */
    public function makeRidesList() {

        $rideModel = new RideModel;
        $columns = ['idUser', 'department', 'date', 'length', 'duration', 'difficulty'];
        
        if (isset($_POST['rideSearch']) && !empty($_POST['rideSearch'])) {
            $rides = $this->findSomeBy($columns, ['region' => $_POST['ridesearch'], 'department' => $_POST['ridesearch']], 'OR');
        }
        // DEFAULT
        else {
            $rides = $this->findSomeBy($columns, $params = [], "");
            var_dump($rides);
        }
        foreach($rides as $ride) {
            $this->getCreatorPseudo($ride);
            var_dump($ride);
        }
    }

    public function getCreatorPseudo($ride) {

        // $creatorModel = new RideModel;
        return $this->findSomeWithJoin(['pseudo'], ['table' => '_user', 'condition' => 'balade.idUser = _user.idUser'], ['idUser' => $ride->idUser]);
        
    }
}