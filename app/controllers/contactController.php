<?php
namespace app\controllers;

use app\models\model;
use app\models\messageModel;

class ContactController {

    public function index() {

        $titre = 'Contact - Ride Connect';
        include ROOT.'/app/views/contact.php';
    }

    public function submitMessage() {

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['contactEmail'], $_POST['contactObject'], $_POST['contactMessage']) && !empty($_POST['contactEmail']) && !empty($_POST['contactObject']) && !empty($_POST['contactMessage'])) {
                // verify email conformity
                if(preg_match('/^[\p{L}\p{N}.!#$%&\'*+\/=?^_`{|}~-]+@[\p{L}\p{N}-]+(\.[\p{L}\p{N}-]+)*(\.[\p{L}]{2,})$/u', $_POST['contactEmail'])) {
                    $email = htmlspecialchars($_POST['contactEmail']);
                    $object = htmlspecialchars($_POST['contactObject']);
                    $message = htmlspecialchars($_POST['contactMessage']);

                    // construct the new message
                    $messageModel = new MessageModel;
                    $messageModel->setSendDate(date('Y-m-d'))
                                ->setEmail($email)
                                ->setObject($object)
                                ->setMessage($message);
                    // var_dump($messageModel);
                    // exit;
                    $result = $messageModel->create();

                    if (isset($result)) {
                        if ($result) {
                            // message sent successfully
                            $_SESSION['message'] = "Votre message a bien été envoyé. Nous vous répondrons le plus rapidement possible.";
                            header('Location: '.$_SERVER['HTTP_ORIGIN'].'/ride-connect/contact');
                            exit;
    
                        } else {
                            // oups... something went wrong
                            $error = "Une erreur s'est produite lors de l'envoi du message. Veuillez réessayer plus tard.";
                            $title = 'Inscription - Ride Connect';
                            include ROOT.'/app/views/contact.php';
                            exit;
                        }
                    }
                    // oups... something went wrong
                    $error = "Une erreur s'est produite lors de l'envoi du message. Veuillez réessayer plus tard.";
                    $title = 'Inscription - Ride Connect';
                    include ROOT.'/app/views/contact.php';
                    exit;
                }
                else {
                    $mailError = "Cette adresse email n'est pas valide.";
                    $title = 'Inscription - Ride Connect';
                    include ROOT.'/app/views/contact.php';
                    exit;
                }
            }
            else {
                $error = "Merci de remplir tous les champs";
                $title = 'Inscription - Ride Connect';
                include ROOT.'/app/views/contact.php';
                exit;
            }
        }
    }
}