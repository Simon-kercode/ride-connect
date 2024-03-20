<?php 
namespace app\models;

use PDO;
use PDOException;

class DbConnector extends PDO {

    private static $instance;

    private const DB_HOST = 'localhost';
    private const DB_USER = 'root';
    private const DB_PASS = '';
    private const DB_NAME = 'rideConnect';

    private function __construct() {

        $dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST;

        //calling class PDO's constructor
        try {
            parent::__construct($dsn, DB_USER, DB_PASS);

            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
        }
        catch(PDOException $e) {
            error_log($e->getMessage());
            die;
        }
    }

    public static function getInstance():self {
        if(self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

}