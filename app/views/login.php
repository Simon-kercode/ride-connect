<?php include ROOT.'/app/views/header.php'; ?>

<main id="loginPage" class="container">
    <section id="login">
        <form action="connexion" method = "post">
            <h1>Connexion</h1>
            <div>
                <input type="text" name="email" placeholder="Adresse email">
            </div>
            <div>
                <input type="password" name="password" placeholder="Mot de passe">
            </div>
            <p class="error"><?php if(!empty($error)) echo $error ?></p>
            <input type="submit" value="Connexion">
        </form>
        <img src="public/images/login.webp" alt="Couple sur une moto sur une route de campagne">
    </section>
</main>

<?php include ROOT.'/app/views/footer.php'; ?>