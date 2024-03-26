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
        <a href="accueil"><img class="logo" src="public/images/logo2.png" alt="Logo Ride Connect"></a>
        <nav id="principalMenu">
            <div>
                <img id="burger" src="public/images/burger.svg" alt="menu burger">
                <img id="closeBurger" src="public/images/close-burger.svg" alt="croix fermeture burger">
            </div>
            <ul id="menuLinks">
                <li><a href="#">Balades</a></li>
                <li><a href="#">A propos</a></li>
                <li><a href="#">Contact</a></li>
                <?php if (isset($_SESSION['user']) && !empty($_SESSION['user']['idUser'])) : ?>
                    <li><a class="coDeco" href="logout">Déconnexion</a></li>
                <?php else : ?>
                    <li><a class="coDeco" href="connexion">Connexion</a></li>
                <?php endif; ?>
                <li><a class="coDeco" href="inscription">Inscription</a></li>
            </ul>
        </nav>
    </header>
    
