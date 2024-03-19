<?php
require dirname(__FILE__) . "/app/core/config.php";

use app\autoloader;

// require RACINE . "/app/core/routage.php";
require RACINE . '/app/autoloader.php';
Autoloader::register();

$action = "accueil";

if (isset($_GET["action"])) {
	$action = redirectTo($_GET["action"]);
}

require RACINE . "/app/controllers/" . $action . "_ctl.php";
?>