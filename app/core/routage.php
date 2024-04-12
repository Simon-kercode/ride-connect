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
use app\controllers\adminController;
use app\controllers\contactController;
use app\controllers\controller404;

    class Routage {
        public function start() {
            // !!!!!!!!!!!!!!!!!!! A DEBUGUER !!!!!!!!!!!!!!!!!!!!!
            // deleting the trailing slash at the end of the url
            // $uri = $_SERVER['REQUEST_URI'];

            // var_dump($uri);
            // if(!empty($uri) && $uri !== '/' && $uri[-1] === '/'){
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
                        if (isset($params[1]) && $params[1] === 'supprimer') {
                            if (isset($params[2]) && ctype_digit($params[2])) {
                                $route->rideDelete();
                            }
                            else {
                                $route->accountDelete($_SESSION['user']['idUser']);
                            }
                        }
                        elseif($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $route->updateInfos();
                        }
                        else {
                            $route->index();
                        }
                    }
                    else {
                        $route = new HomeController;
                        $_SESSION['message'] = "Vous devez vous connecter pour accéder à votre profil";
                        $route->index();
                    }
                    break;

                case 'balades':
                    if (isset($params[1])) {
                        if (ctype_digit($params[1])) {
                            $route = new RidesController;
                            if(!$route->getRideById($params[1])) {
                                $_SESSION['message'] = "Cette balade n'existe pas.";
                                $route->index();
                                exit;
                            } 
                            if (isset($params[2]) && !empty($params[2])){
                                // if(!$route->getRide($params[2], 3)) {
                                if ($params[2] === 'modifier') {
                                    if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
                                        $route = new ModifyController;
                                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                            $route->updateRide();
                                        }
                                        elseif ($route->getRide('modifier', 3)->idUser == $_SESSION['user']['idUser']) {
                                            $route->index();
                                        }  
                                        else {
                                            $route = new RidesController;
                                            $_SESSION['message'] = "Vous n'avez pas l'autorisation de modifier cette balade.";
                                            $route->index();
                                        }
                                    }
                                    else {
                                        $route = new RidesController;
                                        $_SESSION['message'] = "Vous devez vous connecter pour modifier une balade.";
                                        $route->index();
                                    }
                                }
                                elseif ($params[2] ==='participer') {
                                    if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
                                        $route = new RideDetailsController;
                                        if (!$route->verifyParticipation($params[1], $_SESSION['user']['idUser'])) {           
                                            $route->addParticipant();
                                        }
                                        else {
                                            $_SESSION['message'] = "Vous êtes déjà inscrit à cette balade !";
                                            $route = new RideDetailsController;
                                            $route->index();
                                        }
                                    }
                                    else {
                                        $route = new RideDetailsController;
                                        $_SESSION['message'] = "Vous devez être connecté pour participer à une balade.";
                                        $route->index();
                                    }
                                }
                                else {
                                    $route = new controller404;
                                    $route->index();
                                }
                            }
                            
                            else {
                                $route = new RideDetailsController;
                                $route->index();
                            }
                        }
                        elseif($params[1] === 'organiser') {
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                $route = new OrgaController;
                                $route->createRide();
                            }
                            else {
                                if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
                                    $route = new OrgaController;
                                    $route->index();
                                }
                                else {
                                    $_SESSION['message'] = "Vous devez être connecté pour organiser une balade.";
                                    header('Location: '.$_SERVER['HTTP_ORIGIN'].'/ride-connect/balades'); 
                                }
                            }
                        }
                        else {
                            $route = new controller404;
                            $route->index();
                        }
                    }
                    else {
                        $route = new RidesController;
                        $route->index();
                    }
                    break;

                    case 'contact':
                        $route = new ContactController;
                        if($_SERVER['REQUEST_METHOD'] =='POST') {
                            $route->submitMessage();
                        }
                        else {
                            $route->index();
                        }
                        break;

                    case 'administration': 
                        if(isset($_SESSION['user']) && !empty($_SESSION['user']) && $_SESSION['user']['isAdmin'] === 1) {
                            if(isset($params[1]) && !empty($params[1])) {
                                if ($params[1] === 'supprimer') {
                                    if(isset($params[2]) && !empty($params[2])) {
                                         if($params[2] === 'utilisateur') {
                                            if(isset($params[3]) && ctype_digit($params[3])) {
                                                $route = new AdminController;
                                                $route->userDelete();
                                            }
                                            else {
                                                $route = new AdminController;
                                                $_SESSION['message'] = "Veuillez sélectionner un utilisateur à supprimer.";
                                                $route->index();
                                            }
                                        }
                                        elseif(isset($params[2]) && $params[2] === 'balade') {
                                            if(isset($params[3]) && ctype_digit($params[3])) {
                                                $route = new AdminController;
                                                $route->rideDelete();
                                            }
                                            else {
                                                $route = new AdminController;
                                                $_SESSION['message'] = "Veuillez sélectionner une balade à supprimer.";
                                                $route->index();
                                            }
                                        }
                                        else {
                                            $route = new controller404;
                                            $route->index();
                                        }
                                    }
                                    else {
                                        $route = new AdminController;
                                        $_SESSION['message'] = "Veuillez sélectionner un élément à supprimer.";
                                        $route->index();
                                    }
                                }
                                else {
                                    $route = new controller404;
                                    $route->index();
                                }
                                
                            }
                            else {
                                $route = new AdminController;
                                $route->index();
                            }
                        }
                        else {
                            $_SESSION['message'] = "Vous n'avez pas l'autorisation d'accéder à cette partie du site.";
                            $route = new HomeController;
                            $route->index();
                        }
                        break;
                    
                    default:
                        $route = new controller404;
                        $route->index();
            }       
        }
    }
?>