<?php 
namespace app\controllers;

use app\models\userModel;
use app\models\model;

class RegisterController {

    public function index() {

        $title = 'Inscription - Ride Connect';
        include ROOT.'/app/views/register.php';
    }

    public function inscription() {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // verify that all fields are completed
            if (isset($_POST['email'], $_POST['password'], $_POST['passwordConfirm'], $_POST['pseudo'], $_POST['name'], $_POST['firstname']) &&
                !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['passwordConfirm']) && !empty($_POST['pseudo']) && !empty($_POST['name']) && !empty($_POST['firstname'])) {

                $user = new UserModel();
                
                // verify the conformity of the email adress and that it doesn't already exist in the database
                if(preg_match('/^[\p{L}\p{N}.!#$%&\'*+\/=?^_`{|}~-]+@[\p{L}\p{N}-]+(\.[\p{L}\p{N}-]+)*(\.[\p{L}]{2,})$/u', $_POST['email'])) {
                    if($user->verifyExistingMail(htmlspecialchars($_POST['email'])) === false) {
                        $mailError = "Un compte existe déjà pour cette adresse mail.";
                        $title = 'Inscription - Ride Connect';
                        include ROOT.'/app/views/register.php';
                        exit;
                    }
                }
                else {
                    // no valid email adress
                    $mailError = "Cette adresse email n'est pas valide";
                    $title = 'Inscription - Ride Connect';
                    include ROOT.'/app/views/register.php';
                    exit;
                }

                // verify that pseudo doesn't exist in the database
                if($user->verifyExistingPseudo(htmlspecialchars($_POST['pseudo'])) === false) {
                    $pseudoError = "Ce pseudo est déjà utilisé. Veuillez en choisir un autre.";
                    $title = 'Inscription - Ride Connect';
                    include ROOT.'/app/views/register.php';
                    exit;
                }
                
                // password have to contain at least 8 characters, 1 lowercase, 1 uppercase, 1 number and 1 special character 
                if ($_POST['password'] === $_POST['passwordConfirm']) {
                    if(preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\s])\S{8,}$/", $_POST['password']) && preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\s])\S{8,}$/", $_POST['passwordConfirm'])) {
                        // if all conditions ok, get the fields content
                        $email = htmlspecialchars($_POST['email']);
                        $password = password_hash(($_POST['password']), PASSWORD_DEFAULT);
                        $pseudo = htmlspecialchars($_POST['pseudo']);
                        $name = htmlspecialchars($_POST['name']);
                        $firstname = htmlspecialchars($_POST['firstname']);

                        // creating the new user
                        $user->setEmail($email)
                            ->setPassword($password)
                            ->setPseudo($pseudo)
                            ->setName($name)
                            ->setFirstname($firstname);
                        
                        $result = $user->create();

                        if (isset($result)) {
                            
                            if ($result) {
                                // account created successfully
                                $_SESSION['message'] = "Votre compte a bien été créé. Vous pouvez maintenant vous connecter";
                                header('Location: '.$_SERVER['HTTP_ORIGIN'].'/ride-connect/connexion');
                                exit;

                            } 
                            else {
                                // error in database connection
                                $error = "Une erreur s'est produite lors de la création de l'utilisateur. Veuillez réessayer plus tard.";
                                $title = 'Inscription - Ride Connect';
                                include ROOT.'/app/views/register.php';
                                exit;
                            }
                        }
                        else {
                            $error = "Une erreur s'est produite lors de la création de l'utilisateur. Veuillez réessayer plus tard.";
                            $title = 'Inscription - Ride Connect';
                            include ROOT.'/app/views/register.php';
                            exit;
                        }
                    }
                    else {
                        // error in password syntax
                        $passwordError = "Le mot de passe doit contenir au moins 8 caractères comprenant une minuscule, une majuscule, un chiffre et un caractère spécial.";
                        $title = 'Inscription - Ride Connect';
                        include ROOT.'/app/views/register.php';
                    }
                }
                else {
                    // error in corresponding passwords
                    $passwordError = "Vos mots de passe ne correspondent pas.";
                    $title = 'Inscription - Ride Connect';
                    include ROOT.'/app/views/register.php';
                }
                
            } 
            else {
                // at least 1 field is empty
                $error = "Veuillez remplir tous les champs pour valider votre inscription.";
                $title = 'Inscription - Ride Connect';
                include ROOT.'/app/views/register.php';
            }
            
        }
    }
}
    
    
    
