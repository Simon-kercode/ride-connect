<?php
// function redirectTo($action="accueil"){

//     switch($action){
//         case "accueil":
//             return RACINE . "/app/controleur/accueil_ctl.php";
//         case "about":
//             return RACINE . "/app/controleur/about_ctl.php";
//             break;
//         case "findTrip":
//             return RACINE . "/app/controleur/findTrip_ctl.php";
//             break;
//         case "orgaTrip":
//             return RACINE . "/app/controleur/orgaTrip_ctl.php";
//             break;
//         case "roadbook":
//             return RACINE . "/app/controleur/roadbook_ctl.php";
//             break;
//         case "blog":
//             return RACINE . "/app/controleur/blog_ctl.php";
//             break;
//         case "contact":
//             return RACINE . "/app/controleur/contact_ctl.php";
//             break;
//         case "connection":
//             return RACINE . "/app/controleur/connection_ctl.php";
//             break;
//         case "inscription":
//             return RACINE . "/app/controleur/inscription_ctl.php";
//             break;
//         case "profile":
//             return RACINE . "/app/controleur/profile_ctl.php";
//             break;
//         default:
//             return RACINE . "/app/controleur/accueil_ctl.php";
//     }
// }

namespace app\core;

    class Main {

        public function start() {
            // deleting the trailing slash at the end of the url
            $uri = $_SERVER['REQUEST_URI'];

            if(!empty($uri) && $uri != '/' && $uri[-1] === '/'){
                $uri = substr($uri, 0, -1);

                // prevent duplicate content by redirect permanently
                http_response_code(301);

                header('Location: '.$uri);
                exit;
            }

            // separate parameters of the url by '/'
            $params = explode('/', $_GET['p']);

            if($params[0] != ''){
                //getting the controller to instantiate
                $controller = '\\app\\controllers\\'.ucfirst(array_shift($params)).'Controller';

                $action = isset($params[0]) ? array_shift($params) : 'index';

                $controller = new $controller();

                if(method_exists($controller, $action)){

                    (isset($params[0])) ? $controller->$action($params) : $controller->$action();
                }
                else {
                    http_response_code(404);
                    echo "La page recherchée n'existe pas.";
                }
            }
            else {
                // no parameters, instantiate the default controller
                $controller = new MainController;

                $controller->index();
            }

        }
    }
?>