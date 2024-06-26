<?php 

namespace app\models;

use app\models\model;
use app\models\userModel;

class RideModel extends Model {

    protected int $idBalade;
    protected string $title;
    protected $date;
    protected $time;
    protected float $length;
    protected float $duration;
    protected string $difficulty;
    protected int $partNumber;
    protected string $startPoint;
    protected string $arrival;
    protected string $department;
    protected string $region;
    protected string $meetingPoint;
    protected string $precisions;
    protected $map;
    protected string $waypoints;
    protected int $idUser;

    public function __construct() {
        $this->table = 'balade';
    }

     // get the pseudo of a ride's creator
    protected function getCreatorPseudo($ride, $params) {
        $userModel = new UserModel;

        $columns = ['_user.pseudo'];
        return $userModel->findSomeBy($columns, $params);
        // $columns = ['_user.pseudo'];
        // $joinParams = [
        //     [
        //     'table' => '_user',
        //     'condition' => 'balade.idUser = _user.idUser'
        //     ]
        // ];
        // return $this->findSomeWithJoin($columns, $joinParams, $params);
    }

    /* Get the actual url, explode it
     * verify if url has 'participer' param
     * get idBalade position in url and use it to make the request
    */
    public function getRide(string $action, int $pos) {
        $url = $_SERVER['REQUEST_URI'];
        $startIndex = strpos($url, '/ride-connect');
        $newUrl = substr($url, $startIndex);

        $explodeURL = explode('/', $newUrl);
        
        $id = end($explodeURL);
        
        if ($action !== '') {
            if(strpos($newUrl, $action) !== false) {
                $id = $explodeURL[$pos];
            }
        }
        if (isset($id) && !empty($id) && ctype_digit($id)) {
            return($this->findOneByOneParam('idBalade', $id));
        }
    }

    // get a ride by its id
    public function getRideById(int $id) {
        return $this->findOneByOneParam('idBalade', $id);
    }

    /**
     * Get the value of idBalade
     */ 
    protected function getIdBalade()
    {
        return $this->idBalade;
    }

    /**
     * Set the value of idBalade
     *
     * @return  self
     */ 
    protected function setIdBalade($idBalade)
    {
        $this->idBalade = $idBalade;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    protected function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    protected function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of title
     */ 
    protected function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    protected function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of time
     */ 
    protected function getTime()
    {
        return $this->time;
    }

    /**
     * Set the value of time
     *
     * @return  self
     */ 
    protected function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get the value of length
     */ 
    protected function getLength()
    {
        return $this->length;
    }

    /**
     * Set the value of length
     *
     * @return  self
     */ 
    protected function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Get the value of duration
     */ 
    protected function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set the value of duration
     *
     * @return  self
     */ 
    protected function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get the value of difficulty
     */ 
    protected function getDifficulty()
    {
        return $this->difficulty;
    }

    /**
     * Set the value of difficulty
     *
     * @return  self
     */ 
    protected function setDifficulty($difficulty)
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    /**
     * Get the value of partNumber
     */ 
    protected function getPartNumber()
    {
        return $this->partNumber;
    }

    /**
     * Set the value of partNumber
     *
     * @return  self
     */ 
    protected function setPartNumber($partNumber)
    {
        $this->partNumber = $partNumber;

        return $this;
    }

    /**
     * Get the value of startPoint
     */ 
    protected function getStartPoint()
    {
        return $this->startPoint;
    }

    /**
     * Set the value of startPoint
     *
     * @return  self
     */ 
    protected function setStartPoint($startPoint)
    {
        $this->startPoint = $startPoint;

        return $this;
    }

    /**
     * Get the value of department
     */ 
    protected function getDepartment()
    {
        return $this->department;
    }

    /**
     * Set the value of department
     *
     * @return  self
     */ 
    protected function setDepartment($department)
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Get the value of arrival
     */ 
    protected function getArrival()
    {
        return $this->arrival;
    }

    /**
     * Set the value of arrival
     *
     * @return  self
     */ 
    protected function setArrival($arrival)
    {
        $this->arrival = $arrival;

        return $this;
    }

    /**
     * Get the value of region
     */ 
    protected function getRegion()
    {
        return $this->region;
    }

    /**
     * Set the value of region
     *
     * @return  self
     */ 
    protected function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get the value of meetingPoint
     */ 
    protected function getMeetingPoint()
    {
        return $this->meetingPoint;
    }

    /**
     * Set the value of meetingPoint
     *
     * @return  self
     */ 
    protected function setMeetingPoint($meetingPoint)
    {
        $this->meetingPoint = $meetingPoint;

        return $this;
    }

    /**
     * Get the value of precisions
     */ 
    protected function getPrecisions()
    {
        return $this->precisions;
    }

    /**
     * Set the value of precisions
     *
     * @return  self
     */ 
    protected function setPrecisions($precisions)
    {
        $this->precisions = $precisions;

        return $this;
    }

    /**
     * Get the value of map
     */ 
    protected function getMap()
    {
        return $this->map;
    }

    /**
     * Set the value of map
     *
     * @return  self
     */ 
    protected function setMap($map)
    {
        $this->map = $map;

        return $this;
    }

    /**
     * Get the value of waypoints
     */ 
    protected function getWaypoints()
    {
        return $this->waypoints;
    }

    /**
     * Set the value of waypoints
     *
     * @return  self
     */ 
    protected function setWaypoints($waypoints)
    {
        $this->waypoints = $waypoints;

        return $this;
    }

    /**
     * Get the value of idUser
     */ 
    protected function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set the value of idUser
     *
     * @return  self
     */ 
    protected function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }
}