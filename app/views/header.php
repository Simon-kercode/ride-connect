<!DOCTYPE html>
<html lang="fr">
<head>
    <base href="http://localhost/ride-connect/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Organisez et participez à de nombreuses balades moto entre particuliers. Rejoignez une communauté de milliers de motards dans toute la France !">
    <link rel="icon" href="public/images/logo-main.ico" type="image/x-icon">
    <link rel="stylesheet" href="public/styles/style.css">
    <!-- leaflet css -->
    <link rel="stylesheet" href="api/style/leaflet.css">
    <!-- leaflet draw css -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-draw/dist/leaflet.draw.css" />
    <script type="text/javascript" src="public/scripts/scripts.js" defer></script>
    <!-- leaflet js -->
    <script type="text/javascript" src="api/scripts/leaflet.js"></script>
    <!-- leaflet draw js -->
    <script src="https://unpkg.com/leaflet-draw/dist/leaflet.draw.js"></script>
    <?php
    $url = $_SERVER['REQUEST_URI'];
    $startIndex = strpos($url, '/ride-connect');
    $newUrl = substr($url, $startIndex);
    ?>
    <?php if ($newUrl === '/ride-connect/balades/organiser') { ?>
    <!-- script to draw an itinerary in organisation page -->
        <script type="text/javascript" src="public/scripts/mapOrga.js" defer></script>
    <?php } 
    elseif (isset($ride->idBalade) && ($newUrl === '/ride-connect/balades/'.$ride->idBalade || $newUrl === '/ride-connect/balades/'.$ride->idBalade.'/participer')) {?>
    <!-- script to display th ride's itinerary (non modifiable) -->
        <script type="text/javascript" src="public/scripts/mapDetails.js" defer></script>
    <?php } 
    elseif (isset($ride->idBalade) && $newUrl === '/ride-connect/balades/'.$ride->idBalade.'/modifier') {?>
    <!-- script to display th ride's itinerary (modifiable) -->
        <script type="text/javascript" src="public/scripts/mapModify.js" defer></script>
    <?php } ?>
    <title><?= $title ?></title>
</head>
<body>
    <header>
        <a href="accueil" title="Revenir vers l'accueil"><img class="logo" src="public/images/logo2.webp" alt="Logo Ride Connect"></a>
        <nav id="principalMenu">
            <div id="burgerIcons">
                <img id="burger" src="public/images/icons/burger.svg" alt="menu burger">
                <img id="closeBurger" src="public/images/icons/close-burger.svg" alt="croix fermeture burger">
            </div>
            <ul id="menuLinks">
                <li><a href="balades" title="Voir les balades">Balades</a></li>   
                <li><a href="contact" title="Laissez nous un message">Contact</a></li>
                <?php if (isset($_SESSION['user']) && !empty($_SESSION['user']['idUser'])) : ?>
                    <li><a href="profil" title="Votre page de profil" id="profileLink">
                        <img src="public/images/icons/user.svg" alt="icone de profil">
                        <?= $_SESSION['user']['pseudo'] ?>
                    </a></li>
                    <?php if ($_SESSION['user']['isAdmin'] === 1) : ?>
                        <li><a class="button" href="administration">Administration</a></li>
                    <?php endif; ?>
                    <li><a class="button" href="logout">Déconnexion</a></li>
                <?php else : ?>
                    <li><a class="button" href="connexion">Connexion</a></li>
                    <li><a class="button" href="inscription">Inscription</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    
