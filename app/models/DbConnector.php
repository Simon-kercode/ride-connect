<?php 
namespace app\models;

use PDO;
use PDOException;
use Exception;

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
            throw (new PDOException ("Erreur de connexion à la base de données."));
        }
    }

    public static function getInstance(): ?self {
        
            try {
                if(self::$instance === null) {
                self::$instance = new self();
                
                }
            } catch(PDOException $e) {
                error_log($e->getMessage());
                include ROOT.'/app/views/breakdown.php';
                exit;
            }
            return self::$instance;
        }
        
    

}