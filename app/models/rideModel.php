<?php 

namespace app\models;

use Model;

class BaladeModel extends Model {

    protected int $idBalade;
    protected string $title;
    protected $date;
    protected int $long;
    protected float $duration;
    protected string $level;
    protected int $maxParticipants;
    protected string $departure;
    protected string $arrival;
    protected string $department;
    protected string $region;
    protected $map;
    protected array $waypoints;

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
     * Get the value of long
     */ 
    public function getLong()
    {
        return $this->long;
    }

    /**
     * Set the value of long
     *
     * @return  self
     */ 
    public function setLong($long)
    {
        $this->long = $long;

        return $this;
    }

    /**
     * Get the value of level
     */ 
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set the value of level
     *
     * @return  self
     */ 
    public function setLevel($level)
    {
        $this->level = $level;

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
     * Get the value of maxParticipants
     */ 
    public function getMaxParticipants()
    {
        return $this->maxParticipants;
    }

    /**
     * Set the value of maxParticipants
     *
     * @return  self
     */ 
    public function setMaxParticipants($maxParticipants)
    {
        $this->maxParticipants = $maxParticipants;

        return $this;
    }

    /**
     * Get the value of departure
     */ 
    public function getDeparture()
    {
        return $this->departure;
    }

    /**
     * Set the value of departure
     *
     * @return  self
     */ 
    public function setDeparture($departure)
    {
        $this->departure = $departure;

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
}