<?php

namespace app\core;
use app\controllers\homeController;
use app\controllers\registerController;
use app\controllers\userController;
use app\controllers\profileController;
use app\controllers\ridesController;
use app\controllers\orgaController;

    class Routage {
        public function start() {
            // !!!!!!!!!!!!!!!!!!! A DEBUGUER !!!!!!!!!!!!!!!!!!!!!
            // deleting the trailing slash at the end of the url
            // $uri = $_SERVER['REQUEST_URI'];
            // var_dump($uri);
            // if(!empty($uri) && $uri != '/' && $uri[-1] === '/'){
            //     $uri = substr($uri, 0, -1);

            //     // prevent duplicate content by redirect permanently
            //     http_response_code(301);

            //     header('Location: '.$uri);
            //     exit;
            // }
            $params = explode('/', $_GET['p']);
    
            switch($params[0]) {
                case '':
                case '/': 
                    $route = new HomeController;
                    $route->index();
                    break;

                case 'accueil': 
                    $route = new HomeController;
                    $route->index();
                    break;

                case 'inscription': 
                    $route = new RegisterController;
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $route->inscription();
                    }
                    else 
                    $route->index();
                    break;

                case 'connexion':
                    $route = new UserController;
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $route->userLogin();
                    }
                    else
                    $route->index();
                    break;

                case 'logout':
                    $route = new UserController;
                    $route->userLogout();
                    break;
                
                case 'profile':
                    $route = new ProfileController;
                    $route->index();
                    break;

                case 'balades':
                    $route = new RidesController;
                    $route->index();
                    break;

                case 'organiser':
                    $route = new OrgaController;
                    $route->index();
                    break;   
                     
                case 'rideSubmit':
                    $route = new OrgaController;
                    $route->createRide();
                    break;
                            
            }        
        }
    }
?>