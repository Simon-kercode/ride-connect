<?php
namespace app\controllers;

use app\models\rideModel;
use app\models\model;
use app\models\participantModel;

class RideDetailsController extends RideModel{

    public function index() {
        
        $ride = $this->getRide();

        $params = ['idBalade' => $ride->idBalade];
        $pseudo = $this->getCreatorPseudo($ride, $params);

        $participants = new ParticipantModel;
        $partQuantity = $participants->getParticipantsNumber($ride->idBalade);

        $title= $ride->title.' - Ride Connect';
        include ROOT.'/app/views/rideDetails.php';
    }

    /* Get the actual url, explode it
     * verify if url has 'participer' param
     * get idBalade position in url and use it to make the request
    */
    public function getRide() {
        $url = $_SERVER['REQUEST_URI'];
        $explodeURL = explode('/', $url);

        $id = end($explodeURL);

        if(strpos($url, 'participer' || 'modifier') !== false) {
            $id = $explodeURL[3];
        }

        if (isset($id) && !empty($id) && ctype_digit($id)) {
            return($this->findOneByOneParam('idBalade', $id));
        }
    }
}