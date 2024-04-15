<?php include ROOT.'/app/views/header.php'; ?>

<main id="contactPage">
    <h1>Contact</h1>
    <p id="contactText">Un problème ? Une question ? Laissez nous vous aider. Nous vous répondrons dans les meilleurs délais.</p>
    <form action="contact" method="POST">
        <div>
            <input type="email" id="contactEmail" name="contactEmail" placeholder="Votre Email" value="<?php echo (isset($_SESSION['user']) && !empty($_SESSION['user'])) ? $_SESSION['user']['email'] : ''?>">
            <p><?php if (isset($emailError) && !empty($emailError)) echo $emailError ?></p>
        </div>
        <div>
            <input type="text" id="contactObject" name="contactObject" placeholder="Objet du message" maxlength = "30">
        </div>
        <div>
            <textarea name="contactMessage" id="contactMessage" rows="6" placeholder="En quoi pouvons nous vous aider ?"></textarea>
            <p><?php if (isset($error) && !empty($error)) echo $error ?></p>
            <p><?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {echo $_SESSION['message']; unset($_SESSION['message']);}?></p>
        </div>
        
        <div>
            <input class="button" type="submit" value="Envoyer">
        </div>
    </form>
</main>

<?php include ROOT.'/app/views/footer.php'; ?>
