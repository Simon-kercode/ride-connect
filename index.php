<?php
require dirname(__FILE__) . "/app/controleur/config.php";

require RACINE . "/app/controleur/routage.php";

$action = "accueil";

if (isset($_GET["action"])) {
	$action = redirectTo($_GET["action"]);
}

require RACINE . "/app/controleur/" . $action . "_ctl.php";
?>