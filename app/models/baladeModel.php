<?php 

namespace app\models;

use mainModel;

class Balade extends Model {

    private $numBalade;
    protected $author;
    protected $title;
    protected $date;
    protected $long;
    protected $during;
    protected $level;
    protected $maxParticipants;
    protected $start;
    protected $arrival;
    protected $department;
    protected $region;
    protected $map;
    protected $waypoints;
    protected $instructions;

    private function __construct($author, $title, $date, $long, $during, $level, $maxParticipants, $start, $arrival, $department, $region, $map, $waypoints, $instructions) {
        $this->author = $author;
        $this->title = $title;
        $this->date = $date;
        $this->long = $long;
        $this->during = $during;
        $this->level = $level;
        $this->maxParticipants = $maxParticipants;
        $this->start = $start;
        $this->arrival = $arrival;
        $this->department = $department;
        $this->region = $region;
        $this->map = $map;
        $this->waypoints = $waypoints;
        $this->instructions = $instructions;
    }

    private function addBalade() {
        $sql = "INSERT INTO `balades` VALUES (:author, :title, :date, :long, :during, :level, :maxParticipants, :start, :arrival, :department, :region, :map, :waypoints, :instructions)";
        
        $this->request($sql, array(':author'=>$author, ':title'=>$title, ':date'=>$date, ':long'=>$long, ':during'=>$during, ':level'=>$level, ':maxParticipants'=>$maxParticipants, ':start'=>$start, ':arrival'=>$arrival, ':department'=>$department, ':region'=>$region, ':map'=>$map, ':waypoints'=>$waypoints, ':instructions'=>$instructions));
        
        return $this;
    }

}