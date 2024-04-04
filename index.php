<?php
session_start();

define("ROOT", dirname(__FILE__));

require ROOT.'/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$current_page = $_SERVER['REQUEST_URI'];

use app\core\routage;

$routage = new routage;
$routage->start();

?>