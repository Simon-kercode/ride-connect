<?php

namespace app\core;
use app\controllers\homeController;
use app\controllers\registerController;
use app\controllers\userController;
use app\controllers\profileController;
use app\controllers\ridesController;
use app\controllers\orgaController;
use app\controllers\rideDetailsController;
use app\controllers\modifyController;

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
                    else {
                        $route->index();
                    } 
                    break;

                case 'connexion':
                    $route = new UserController;
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $route->userLogin();
                    }
                    else {
                        $route->index();
                    } 
                    break;

                case 'logout':
                    $route = new UserController;
                    $route->userLogout();
                    break;
                
                case 'profil':
                    if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
                        $route = new ProfileController;
                        $route->index();
                    }
                    else {
                        $route = new HomeController;
                        $route->index();
                    }
                    break;

                case 'balades':
                    if(isset($params[2]) && $params[2] === 'modifier') {
                        if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
                            $route = new RideDetailsController;
                            if ($route->getRide()->idUser == $_SESSION['user']['idUser']) {
                                $route = new ModifyController;
                                $route->index();
                            }  
                            else {
                                $route = new RidesController;
                                $_SESSION['message'] = "Vous devez vous connecter pour modifier cette balade.";
                                $route->index();
                            }
                        }
                        else {
                            $route = new RidesController;
                            $_SESSION['message'] = "Vous devez vous connecter pour modifier cette balade.";
                            $route->index();
                        }
                        
                    }
                    elseif (isset($params[2]) && $params[2] === 'participer') {
                        if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
                            $route = new RideDetailsController;
                            $_SESSION['message'] = "Vous êtes bien inscrit à cette balade ! Retrouvez y les détails sur votre profil.";
                            $route->index();
                        }
                        else {
                            $route = new RideDetailsController;
                            $_SESSION['message'] = "Vous devez être connecté pour participer à une balade.";
                            $route->index();
                        }
                    }
                    elseif (isset($params[1]) && ctype_digit($params[1])) {
                        $route = new RideDetailsController;
                        $route->index();
                    }
                    else {
                        $route = new RidesController;
                        $route->index();
                    }
                    break;
                    
                case 'organiser':
                    $route = new OrgaController;
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $route->createRide();
                    }
                    else {
                        if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
                        $route->index();
                        }
                        else {
                            $_SESSION['message'] = "Vous devez être connecté pour organiser une balade.";
                            $route = new RidesController;
                            $route->index();
                        }
                    }
                    break;   
                
            }       
        }
    }
?>