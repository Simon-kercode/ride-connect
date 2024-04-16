<?php
session_start();

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

define("ROOT", dirname(__FILE__));

// get actual URL and define the base
$current_url = $_SERVER['REQUEST_URI'];
define("BASE_URL", substr($current_url, 0, strpos($current_url, '/ride-connect')));

require ROOT.'/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use app\core\routing;

$routage = new Routing;
$routage->start();

?>