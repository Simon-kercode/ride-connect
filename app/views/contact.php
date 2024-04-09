<?php include ROOT.'/app/views/header.php'; ?>

<main id="contactPage">
    <h1>Contact</h1>
    <form action="" method="POST">
        <div>
            <input type="email" id="contactEmail" name="contactEmail" placeholder="Votre Email" value="<?php echo (isset($_SESSION['user']) && !empty($_SESSION['user'])) ? $_SESSION['user']['email'] : ''?>">
        </div>
        <div>
            <input type="text" id="objetContact" name="objetContact" placeholder="Objet du message">
        </div>
        <div>
            <textarea name="messageContact" id="messageContact" cols="30" rows="10" placeholder="En quoi pouvons nous vous aider ?"></textarea>
        </div>
    </form>
</main>

<?php include ROOT.'/app/views/footer.php'; ?>