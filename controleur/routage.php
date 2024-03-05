<?php
function redirectTo($action="default"){

    switch($action){
        case "about":
            return RACINE . "/controleur/about_ctl.php";
            break;
        case "findTrip":
            return RACINE . "/controleur/findTRIP_ctl.php";
            break;
        case "orgaTrip":
            return RACINE . "/controleur/orgaTrip_ctl.php";
            break;
        case "roadbook":
            return RACINE . "/controleur/roadbook_ctl.php";
            break;
        case "blog":
            return RACINE . "/controleur/blog_ctl.php";
            break;
        case "contact":
            return RACINE . "/controleur/contact_ctl.php";
            break;
        case "connection":
            return RACINE . "/controleur/connection_ctl.php";
            break;
        case "inscription":
            return RACINE . "/controleur/inscription_ctl.php";
            break;
        case "profile":
            return RACINE . "/controleur/profile_ctl.php";
            break;
    }
}

?>