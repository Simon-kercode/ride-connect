<?php include ROOT . "/app/views/header.php"; ?>

<main id="homePage">
    <section>
        <div id="welcome">
            <?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {echo $_SESSION['message']; unset($_SESSION['message']);} ?>
            <h1>Les balades<br> collaboratives</h1>
            <form action="balades" method="POST">
                <input id="welcomeSearch" type="search" name="rideSearch" placeholder="Recherche par département, région...">
                <input type="submit" id="go" class="particle" value="GO !">
            </form>
        </div>
    </section>
    <section id="presentation">
        <div class="container">
            <h2>Organisez et participez à des balades épiques</h2>
            <p>
                Découvrez l'aventure qui vous attend avec Ride Connect ! Notre plateforme est votre compagnon idéal pour explorer de nouveau horizons à moto, 
                rencontrer d'autres passionnées et partager des expériences inoubliables. Que vous soyez motard chevronné ou un amateur en quête de 
                nouvelles routes, Ride Connect vous offre une communauté dynamique et des outils innovants pour organiser, participer et vivre des balades inoubliables.
                Rejognez nous dès aujourd'hui et laissez vous inspirer par la passion du 2 roues !
            </p>
            <a class="button" href="inscription">Inscription</a>
        </div>
    </section>
    <section class="rides container">
        <h2>Prochaines balades</h2>
        <div class="rideContainer">
            <?php for ($i=0; $i <= 3; $i++) : if (isset($rides[$i]) && !empty($rides[$i])) :?>
                <a class="rideItem" href="balades/<?= $rides[$i]->idBalade ?>">
                <article >
                    <h3><?= $rides[$i]->title?></h3>
                    <div class="flex"> 
                        <p class="particle"><?= substr($pseudos[$i][0]->pseudo, 0, 1) ?></p>
                        <p><?= $pseudos[$i][0]->pseudo?></p>
                    </div>
                    <div class="flex location">
                        <img src="public/images/icons/location.svg" alt="Croix de localisation">
                        <p><?= $rides[$i]->department ?></p>
                    </div>
                    <div class="flexSpace">
                        <div class="flex">
                            <img src="public/images/icons/calendar.svg" alt="Calendrier">
                            <p><?= date("d/m/Y", strtotime($rides[$i]->date)) ?></p>
                        </div>
                        <div class="flex">
                            <img src="public/images/icons/road.svg" alt="Route">
                            <p><?= $rides[$i]->length ?> km</p>
                        </div>
                    </div>
                    <div class="flexSpace">
                        <div class="flex">
                            <img src="public/images/icons/clock.svg" alt="Horloge">
                            <p>
                                <?php 
                                if((($rides[$i]->duration)/60) < 1) {
                                    echo (round(($rides[$i]->duration)%60).' min');
                                }
                                else {
                                    echo (floor(($rides[$i]->duration)/60).'h'.sprintf('%02d', (round($rides[$i]->duration)%60))) ;
                                }
                                ?>
                            </p>
                        </div>
                        <div class="flex">
                            <img src="public/images/icons/level.svg" alt="Barres indiquant différents niveaux">
                            <p><?= ucfirst($rides[$i]->difficulty) ?></p>
                        </div>
                    </div>
                </article>
                </a>
            <?php endif ?>
            <?php endfor ?>
        </div>
    </section>
</main>

<?php include ROOT . "/app/views/footer.php"; ?>