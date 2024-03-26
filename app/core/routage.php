<?php

namespace app\core;
use app\controllers\homeController;
use app\controllers\inscriptionController;
use app\controllers\connectionController;
use app\controllers\logoutController;

    class Routage {
        public function start() {
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
                    $route = new HomeController;
                    $route->index();
                    break;

                case 'accueil': 
                    session_start();
                    $route = new HomeController;
                    $route->index();
                    break;

                case 'inscription': 
                    $route = new InscriptionController;
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $route->inscription();
                    }
                    else 
                    $route->index();
                    break;

                case 'connexion':
                    $route = new ConnectionController;
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $route->userLogin();
                    }
                    else
                    $route->index();
                    break;

                case 'logout':
                    $route = new LogoutController;
                    $route->userLogout();
                    break;
            }
        }
        // public function start() {
            // // deleting the trailing slash at the end of the url
            // $uri = $_SERVER['REQUEST_URI'];
            // var_dump($uri);
            // if(!empty($uri) && $uri != '/' && $uri[-1] === '/'){
            //     $uri = substr($uri, 0, -1);

            //     // prevent duplicate content by redirect permanently
            //     http_response_code(301);

            //     header('Location: '.$uri);
            //     exit;
            // }

        //     // separate parameters of the url by '/'
        //     $params = explode('/', $_GET['p']);
        //     var_dump($params);
        //     if($params[0] != ''){
        //         //getting the controller to instantiate
        //         $controller = '\\app\\controllers\\'.array_shift($params).'Controller';
        //         // getting the 2nd parameter if it exists
        //         $action = isset($params[0]) ? array_shift($params) : 'index';

        //         $controller = new $controller();

        //         if(method_exists($controller, $action)){
        //             // if there's still parameters, calling method 
        //             (isset($params[0])) ? $controller->$action($params) : $controller->$action();
        //         }
        //         else {
        //             http_response_code(404);
        //             echo "La page recherchée n'existe pas.";
        //         }
        //     }
        //     else {
        //         // no parameters, instantiate the default controller
        //         $controller = new MainController();

        //         $controller->index();
        //     }

        // }
    }
?>