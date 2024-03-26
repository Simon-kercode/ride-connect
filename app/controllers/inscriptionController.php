<?php 
namespace app\controllers;

use app\models\userModel;
use app\models\model;
use app\core\form;

class InscriptionController extends Controller{

    public function inscription() {
        
        $form = new Form;

        $form->addInput('email', 'email', 'Votre Email', '')
            ->addInput('password', 'password', 'Entrez un mot de passe', '')
            ->addInput('text', 'pseudo', 'Choisissez un pseudo', '')
            ->addInput('text', 'name', 'Votre Nom', '')
            ->addInput('text', 'firstname', 'Votre Prénom', '')
            ->addButton('submit', "Je m'inscris");
        
        $this->render('inscription', ['registerForm' => $form->createForm()]);

        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['email'], $_POST['mdp'], $_POST['pseudo'], $_POST['name'], $_POST['firstname'])) {
                
                $email = $_POST['email'];
                $password = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
                $pseudo = $_POST['pseudo'];
                $name = $_POST['name'];
                $firstname = $_POST['firstname'];

                $user = new UserModel();

                $user->setEmail($email)
                    ->setPassword($password)
                    ->setPseudo($pseudo)
                    ->setName($name)
                    ->setFirstname($firstname)
                    ->setIsAdmin(0);
                var_dump($user);
                $user->create();

                if (isset($result)) {
                    if ($result) {
                        // Insertion réussie
                        echo "Utilisateur créé avec succès.";
                    } else {
                        // Erreur lors de l'insertion
                        echo "Une erreur s'est produite lors de la création de l'utilisateur.";
                    }
                }
            } else {
                // Données manquantes dans le formulaire
                echo "Veuillez fournir toutes les informations nécessaires.";
            }
        }
    }
}