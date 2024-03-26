<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/styles/style.css">
    <script type="text/javascript" src="public/scripts/menu.js" defer></script>
    <title><?= $titre ?></title>
</head>
<body>
    <header>
        <img class="logo" src="public/images/logo2.png" alt="Logo Ride Connect">
        <nav id="principalMenu">
            <div>
                <img id="burger" src="public/images/burger.svg" alt="menu burger">
                <img id="closeBurger" src="public/images/close-burger.svg" alt="croix fermeture burger">
            </div>
            <ul id="menuLinks">
                <li><a href="#">Balades</a></li>
                <li><a href="#">A propos</a></li>
                <li><a href="#">Contact</a></li>
                <li><a class="coDeco" href="connection">Connexion</a></li>
                <li><a class="coDeco" href="inscription">Inscription</a></li>
            </ul>
        </nav>
    </header>
    
    <?= $content ?>

    <footer>
    <div id="upFooter">
        <div id="leftFooter">
            <img class="logo" src="public/images/logo-white.png" alt="logo Ride Connect">
            <div id="ntw">
                <a href="#"><img src="public/images/reseaux/facebook.svg" alt="logo facebook"></a>
                <a href="#"><img src="public/images/reseaux/instagram.svg" alt="logo instagram"></a>
            </div>
        </div>
        <div id="rightFooter">
            <img src="public/images/arrow-up.svg" alt="fleche de remontée d'écran">
            <ul>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Confidentialité</a></li>
                <li><a href="#">Mentions légales</a></li>
            </ul>
        </div>
    </div>
    <p id="copyright">&copy; Ride Connect 2024</p>
</footer>