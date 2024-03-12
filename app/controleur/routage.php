<?php
function redirectTo($action="accueil"){

    switch($action){
        case "accueil":
            return RACINE . "/app/controleur/accueil_ctl.php";
        case "about":
            return RACINE . "/app/controleur/about_ctl.php";
            break;
        case "findTrip":
            return RACINE . "/app/controleur/findTrip_ctl.php";
            break;
        case "orgaTrip":
            return RACINE . "/app/controleur/orgaTrip_ctl.php";
            break;
        case "roadbook":
            return RACINE . "/app/controleur/roadbook_ctl.php";
            break;
        case "blog":
            return RACINE . "/app/controleur/blog_ctl.php";
            break;
        case "contact":
            return RACINE . "/app/controleur/contact_ctl.php";
            break;
        case "connection":
            return RACINE . "/app/controleur/connection_ctl.php";
            break;
        case "inscription":
            return RACINE . "/app/controleur/inscription_ctl.php";
            break;
        case "profile":
            return RACINE . "/app/controleur/profile_ctl.php";
            break;
        default:
            return RACINE . "/app/controleur/accueil_ctl.php";
    }
}

?>