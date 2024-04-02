<?php 

namespace app\models;

use Model;

class BaladeModel extends Model {

    protected int $idBalade;
    protected string $title;
    protected $date;
    protected $time;
    protected int $length;
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
    protected array $waypoints;
    protected int $idUser;

    private function __construct() {
        $this->table = 'balade';
    }

    

    /**
     * Get the value of idBalade
     */ 
    public function getIdBalade()
    {
        return $this->idBalade;
    }

    /**
     * Set the value of idBalade
     *
     * @return  self
     */ 
    public function setIdBalade($idBalade)
    {
        $this->idBalade = $idBalade;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of time
     */ 
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set the value of time
     *
     * @return  self
     */ 
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get the value of length
     */ 
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set the value of length
     *
     * @return  self
     */ 
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Get the value of duration
     */ 
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set the value of duration
     *
     * @return  self
     */ 
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get the value of difficulty
     */ 
    public function getDifficulty()
    {
        return $this->difficulty;
    }

    /**
     * Set the value of difficulty
     *
     * @return  self
     */ 
    public function setDifficulty($difficulty)
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    /**
     * Get the value of partNumber
     */ 
    public function getPartNumber()
    {
        return $this->partNumber;
    }

    /**
     * Set the value of partNumber
     *
     * @return  self
     */ 
    public function setPartNumber($partNumber)
    {
        $this->partNumber = $partNumber;

        return $this;
    }

    /**
     * Get the value of startPoint
     */ 
    public function getStartPoint()
    {
        return $this->startPoint;
    }

    /**
     * Set the value of startPoint
     *
     * @return  self
     */ 
    public function setStartPoint($startPoint)
    {
        $this->startPoint = $startPoint;

        return $this;
    }

    /**
     * Get the value of department
     */ 
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Set the value of department
     *
     * @return  self
     */ 
    public function setDepartment($department)
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Get the value of arrival
     */ 
    public function getArrival()
    {
        return $this->arrival;
    }

    /**
     * Set the value of arrival
     *
     * @return  self
     */ 
    public function setArrival($arrival)
    {
        $this->arrival = $arrival;

        return $this;
    }

    /**
     * Get the value of region
     */ 
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set the value of region
     *
     * @return  self
     */ 
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get the value of meetingPoint
     */ 
    public function getMeetingPoint()
    {
        return $this->meetingPoint;
    }

    /**
     * Set the value of meetingPoint
     *
     * @return  self
     */ 
    public function setMeetingPoint($meetingPoint)
    {
        $this->meetingPoint = $meetingPoint;

        return $this;
    }

    /**
     * Get the value of precisions
     */ 
    public function getPrecisions()
    {
        return $this->precisions;
    }

    /**
     * Set the value of precisions
     *
     * @return  self
     */ 
    public function setPrecisions($precisions)
    {
        $this->precisions = $precisions;

        return $this;
    }

    /**
     * Get the value of map
     */ 
    public function getMap()
    {
        return $this->map;
    }

    /**
     * Set the value of map
     *
     * @return  self
     */ 
    public function setMap($map)
    {
        $this->map = $map;

        return $this;
    }

    /**
     * Get the value of waypoints
     */ 
    public function getWaypoints()
    {
        return $this->waypoints;
    }

    /**
     * Set the value of waypoints
     *
     * @return  self
     */ 
    public function setWaypoints($waypoints)
    {
        $this->waypoints = $waypoints;

        return $this;
    }

    /**
     * Get the value of idUser
     */ 
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set the value of idUser
     *
     * @return  self
     */ 
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }
}