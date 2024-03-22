<?php 
use app\models\UserModel;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email'], $_POST['mdp'], $_POST['pseudo'], $_POST['name'], $_POST['firstname'])) {
        $email = $_POST['email'];
        $password = $_POST['mdp'];
        $pseudo = $_POST['pseudo'];
        $name = $_POST['name'];
        $firstname = $_POST['firstname'];

        $user = new UserModel($email, $password, $pseudo, $name, $firstname, false);
        
        $req = $user->createUser([
            'email' => $email,
            'password' => $password,
            'pseudo' => $pseudo,
            'name' => $name,
            'firstname' => $firstname
        ]);
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