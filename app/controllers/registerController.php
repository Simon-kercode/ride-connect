<?php 
namespace app\controllers;

use app\models\userModel;
use app\models\model;

class RegisterController {

    public function index() {

        $titre = 'Inscription - Ride Connect';
        include ROOT.'/app/views/inscription.php';
    }

    public function inscription() {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // verify that all fields are completed
            if (isset($_POST['email'], $_POST['password'], $_POST['pseudo'], $_POST['name'], $_POST['firstname']) &&
                !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['pseudo']) && !empty($_POST['name']) && !empty($_POST['firstname'])) {

                $user = new UserModel();
                
                // verify that email adress doesn't exist in the database
                if($user->verifyExistingMail(htmlspecialchars($_POST['email'])) === false) {
                    $error = "Un compte existe déjà pour cette adresse mail.";
                    include ROOT.'/app/views/register.php';
                    exit;
                }

                // verify that pseudo doesn't exist in the database
                if($user->verifyExistingPseudo(htmlspecialchars($_POST['pseudo'])) === false) {
                    $error = "Ce pseudo est déjà utilisé. Veuillez en choisir un autre.";
                    include ROOT.'/app/views/register.php';
                    exit;
                }
                
                // password have to contain at least 8 characters, 1 lowercase, 1 uppercase, 1 number and 1 special character 
                if (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\s])\S{8,}$/", $_POST['password'])) {

                    // if all conditions ok, get the fields content
                    $email = htmlspecialchars($_POST['email']);
                    $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);
                    $pseudo = htmlspecialchars($_POST['pseudo']);
                    $name = htmlspecialchars($_POST['name']);
                    $firstname = htmlspecialchars($_POST['firstname']);

                    // creating the new user
                    $user->setEmail($email)
                        ->setPassword($password)
                        ->setPseudo($pseudo)
                        ->setName($name)
                        ->setFirstname($firstname)
                        ->setIsAdmin(0);
                    
                    $result = $user->create();

                    if (isset($result)) {
                        
                        if ($result) {
                            // account created successfully
                            $_SESSION['message'] = "Votre compte a bien été créé. Vous pouvez maintenant vous connecter";
                            header('Location: connexion');
                            exit;

                        } else {
                            // error in database connection
                            $error = "Une erreur s'est produite lors de la création de l'utilisateur. Veuillez réessayer plus tard.";
                            include ROOT.'/app/views/register.php';
                            exit;
                        }
                    }
                }
                else {
                    // error in password syntax
                    $error = "Le mot de passe doit contenir au moins 8 caractères comprenant une minuscule, une majuscule, un chiffre et un caractère spécial.";
                    include ROOT.'/app/views/register.php';
                }
            } 
            else {
                // at least 1 field is empty
                $error = "Veuillez fournir toutes les informations nécessaires.";
                include ROOT.'/app/views/register.php';
            }
            
        }
    }
}
    
    
    
