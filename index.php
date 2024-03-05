<?php
require dirname(__FILE__) . "/controleur/config.php";

require RACINE . "/controleur/routage.php";

if (isset($_GET["action"])) {
	$action = redirectTo($_GET["action"]);
}

require RACINE . "/controleur/" . $action;
?>