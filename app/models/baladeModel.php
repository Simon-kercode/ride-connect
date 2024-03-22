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

    private function __construct($title, $date, $long, $duration, $level, $maxParticipants, $departure, $arrival, $department, $region, $map, $waypoints) {
        $this->title = $title;
        $this->date = $date;
        $this->long = $long;
        $this->duration = $duration;
        $this->level = $level;
        $this->maxParticipants = $maxParticipants;
        $this->departure = $departure;
        $this->arrival = $arrival;
        $this->department = $department;
        $this->region = $region;
        $this->map = $map;
        $this->waypoints = $waypoints;
    }

    public function createBalade(array $params) {
        $sql = "INSERT INTO `balades` (title, date, long, duration, level, maxParticipants, departure, arrival, department, region, map, waypoints) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        // prepare values to execute the query
        $values = [
            $params['title'],
            $params['date'],
            $params['long'],
            $params['duration'],
            $params['level'],
            $params['maxParticipants'],
            $params['departure'],
            $params['arrival'],
            $params['department'],
            $params['region'],
            $params['map'],
            $params['waypoints']
        ];
        
        $result = $this->request($sql, $values);
        
        return $result;
    }

    public function findBaladeBy(array $criteria) {
        $fields = [];
        $values = [];
        
        foreach($criteria as $field => $value){
            $fields[] = "$field = ?";
            $values[] = $value;
        }
        // transforms fields array into a string
        $fieldsList = implode(' AND ', $fields);

        $result = $this->request('SELECT * FROM `balade` WHERE '.$fieldsList, $values)->fetchAll();
        return $result;
    }

    public function updateBalade(int $idBalade, array $params) {
        $fields = [];
        $values = [];

        foreach($params as $field => $value) {
            $fields[] = "$field = ?";
            $values[] = $value;
        }

        $fieldsList = implode(', ', $fields);
        $result = $this->request('UPDATE `balade` SET '.$fieldsList. 'WHERE id='.$idBalade, $valeurs);

        return $result;
    }

    public function deleteBalade(int $idBalade) {
        $result = $this->request('DELETE FROM `balade` WHERE id='.$idBalade);

        return $result;
    }
}