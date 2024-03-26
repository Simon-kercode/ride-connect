<?php
require "app/core/config.php";

use app\autoloader;
use app\core\routage;

require ROOT . '/app/autoloader.php';
Autoloader::register();

$routage = new Routage;

$routage->start();


?>