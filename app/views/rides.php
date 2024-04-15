<?php include ROOT.'/app/views/header.php'; ?>

<main id="ridesPage" class="container">
    <h1>Trouver ma balade</h1>
    <section id="searchCreate">
        <form action="" method="POST">
            <input type="search" name="rideSearch" placeholder="Recherche par département ou région">
            <input type="submit" class="formBtn button" value="Rechercher">
        </form>
        <a id="orgaBtn" class="button" href="balades/organiser">Créer ma balade</a>
    </section>
    <p class="isConnected"><?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {echo $_SESSION['message']; unset($_SESSION['message']);}?></p>
    <section id="rideList" class="container">
        <?php if (isset($rides)) : ?>
            <p> 
                <?php if (isset($_POST["rideSearch"]) && !empty($_POST["rideSearch"])) {
                    echo "Nous t'avons trouvé ".count($rides)." balade".(count($rides) != 1 ? "s" :'');
                } 
                ?>
            </p>
            <div class="rides">
                <div class="rideContainer">
                    <?php foreach ($rides as $index => $ride) :?>
                        <a class="rideItem" href="balades/<?= $ride->idBalade ?>">
                            <article>
                                <h3><?= $ride->title?></h3>
                                <div class="flex"> 
                                    <p class="particle"><?= substr($pseudos[$index][0]->pseudo, 0, 1) ?></p>
                                    <p><?= $pseudos[$index][0]->pseudo ?></p>
                                </div>
                                <div class="flex location">
                                    <img src="public/images/icons/location.svg" alt="Croix de localisation">
                                    <p><?= $ride->department ?></p>
                                </div>
                                <div class="flexSpace">
                                    <div class="flex">
                                        <img src="public/images/icons/calendar.svg" alt="Calendrier">
                                        <p><?= date("d/m/Y", strtotime($ride->date)) ?></p>
                                    </div>
                                    <div class="flex">
                                        <img src="public/images/icons/road.svg" alt="Route">
                                        <p><?= $ride->length ?> km</p>
                                    </div>
                                </div>
                                <div class="flexSpace">
                                    <div class="flex">
                                        <img src="public/images/icons/clock.svg" alt="Horloge">
                                        <p>
                                            <?php 
                                            if((($ride->duration)/60) < 1) {
                                                echo ((round($ride->duration)%60).' min');
                                            }
                                            else {
                                                echo (floor(($ride->duration)/60).'h'.sprintf('%02d', (floor($ride->duration)%60))) ;
                                            }
                                            ?>
                                        </p>
                                    </div>
                                    <div class="flex">
                                        <img src="public/images/icons/level.svg" alt="Barres indiquant différents niveaux">
                                        <p><?= ucfirst($ride->difficulty) ?></p>
                                    </div>
                                </div>
                            </article>
                        </a> 
                    <?php endforeach ?>  
                </div>
            </div>  
        <?php endif ?>
        </div>
    </section>
</main>

<?php include ROOT.'/app/views/footer.php'; ?>