<?php include ROOT.'/app/views/header.php'; ?>
<main id="registerPage" class="container">
    <h1>Inscription</h1>
    <!-- <p><?php// if (isset($_SESSION['message']) && !empty($_SESSION['message'])) echo $_SESSION['message'] ?></p> -->
    <form action="inscription" method="post" id="registerForm">
        <div id="gridContainer">
            <div>
                <input type="text" name="email" placeholder="Votre adresse Email" value="<?= (isset($mailError) && !empty($mailError)) ? '' : (isset($_POST['email']) ? $_POST['email'] : '')?>">
                <p class="error"><?php if(isset($mailError) && !empty($mailError)) echo $mailError ?></p>
            </div>
            <div>
                <input type="text" name="pseudo" placeholder="Choisissez un Pseudo" value="<?= (isset($pseudoError) && !empty($pseudoError))? '' : (isset($_POST['pseudo']) ? $_POST['pseudo'] : '')?>">
                <p class="error"><?php if(isset($pseudoError) && !empty($pseudoError)) echo $pseudoError ?></p>
            </div>
            <div>
                <input type="password" name="password" placeholder="Mot de passe">
                <p class="error"><?php if(isset($passwordError) && !empty($passwordError)) echo $passwordError ?></p>
            </div>
            <div>
                <input type="password" name="passwordConfirm" placeholder="Confirmez votre Mot de passe">
            </div>
            <div>
                <input type="text" name="name" placeholder="Votre nom" value="<?= isset($_POST['name']) ? $_POST['name'] : ''?>">
            </div>
            <div>
                <input type="text" name="firstname" placeholder="Votre Prénom" value="<?= isset($_POST['firstname']) ? $_POST['firstname'] : ''?>">
            </div>
        </div>
        <div id="rgpd">
            <input type="checkbox" name="rgpd" class="checkbox">
            <label for="rgpd"> En m'inscrivant, j'accepte la <a href="#">politique de confidentialité</a> et les <a href="#">conditions d'utilisation</a> de Ride Connect</label>
        </div>
        <p class="error"><?php if(isset($error) && !empty($error)) echo $error ?></p>
        <input type="submit" value="Commencer l'aventure" class="formBtn" disabled>
    </form>
</main>
<?php include ROOT.'/app/views/footer.php'; ?>