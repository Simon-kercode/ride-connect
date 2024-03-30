<?php 
namespace app\models;

use PDO;
use PDOException;


class DbConnector extends PDO {

    private static $instance;

    public function __construct() {
        $dsn = 'mysql:dbname='.$_ENV['DB_NAME'].';host='.$_ENV['DB_HOST'];

        //calling class PDO's constructor
        try {
            parent::__construct($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS']);

            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) {
            error_log($e->getMessage());
        }
    }

    public static function getInstance(): ?self {
        if(self::$instance === null) {
            try {
                self::$instance = new self();
            } catch(PDOException $e) {
                error_log($e->getMessage());
                $_SESSION['error'] = "Cette fonctionnalité est actuellement indisponible. Nos excuses pour la gêne occasionée.";
                return null;
            }
        }
        return self::$instance;
    }

}