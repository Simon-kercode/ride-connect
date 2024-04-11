<?php include ROOT . "/app/views/header.php"; ?>

<main id="homePage">
    <section>
        <div id="welcome">
            <?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {echo $_SESSION['message']; unset($_SESSION['message']);} ?>
            <h1>Rouler,<br> ensemble</h1>
            <form action="balades" method="POST">
                <input id="welcomeSearch" type="search" name="rideSearch" placeholder="Recherche par département, région...">
                <input type="submit" id="go" class="particle" value="GO !">
            </form>
        </div>
    </section>
    <section class="rides container">
        <h2>Prochaines balades</h2>
        <div class="rideContainer">
            <?php for ($i=0; $i < 3; $i++) : if (isset($rides[$i]) && !empty($rides[$i])) :?>
                <a class="rideItem" href="balades/<?= $rides[$i]->idBalade ?>">
                <article >
                    <h3><?= $rides[$i]->title?></h3>
                    <div class="flex"> 
                        <p class="particle"><?= substr($pseudo[$i]->pseudo, 0, 1) ?></p>
                        <p><?= $pseudo[$i]->pseudo?></p>
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