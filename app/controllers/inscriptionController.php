<?php 
namespace app\controllers;

use app\models\userModel;
use app\models\model;

class InscriptionController {

    public function index() {
        $titre = 'Inscription - Ride Connect';
        include ROOT.'/app/views/inscription.php';
    }

    public function inscription() {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['email'], $_POST['password'], $_POST['pseudo'], $_POST['name'], $_POST['firstname']) &&
                !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['pseudo']) && !empty($_POST['name']) && !empty($_POST['firstname'])) {

                $user = new UserModel();
                var_dump($user);
                $emailVerify = $user->findOneByMail(htmlspecialchars($_POST['email']));
                    var_dump($emailVerify);
                if(!$emailVerify) {
                    $error = "Un compte existe déjà pour cette adresse mail";
                    exit;
                }
                
                if (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\s])\S{8,}$/", $_POST['password'])) {

                    $email = htmlspecialchars($_POST['email']);
                    $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);
                    $pseudo = htmlspecialchars($_POST['pseudo']);
                    $name = htmlspecialchars($_POST['name']);
                    $firstname = htmlspecialchars($_POST['firstname']);

                    

                    $user->setEmail($email)
                        ->setPassword($password)
                        ->setPseudo($pseudo)
                        ->setName($name)
                        ->setFirstname($firstname)
                        ->setIsAdmin(0);
                    // var_dump($user);
                    $result = $user->create();

                    if (isset($result)) {
                        // var_dump($result);
                        if ($result) {
                            // Insertion réussie
                            $_SESSION['message'] = "Votre compte a bien été créé. Vous pouvez maintenant vous connecter";
                            exit;

                        } else {
                            // Erreur lors de l'insertion
                            $error = "Une erreur s'est produite lors de la création de l'utilisateur. Veuillez réessayer plus tard.";
                            include ROOT.'/app/views/inscription.php';
                            exit;
                        }
                    }
                }
                else {
                    $error = "Le mot de pass doit contenir au moins 8 caractères comprenant une minuscule, une majuscule, un chiffre et un caractère spécial.";
                    include ROOT.'/app/views/inscription.php';
                }
            } 
            else {
                // Données manquantes dans le formulaire
                $error = "Veuillez fournir toutes les informations nécessaires.";
                include ROOT.'/app/views/inscription.php';
            }
            
        }
    }
}
    
    
    
