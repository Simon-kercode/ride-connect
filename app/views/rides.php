<?php include ROOT.'/app/views/header.php'; ?>

<main id="ridesPage" class="container">
    <h1>Trouver ma balade</h1>
    <section id="searchCreate">
        <form action="" method="POST">
            <input type="search" name="rideSearch" placeholder="Recherche par département ou région">
            <input type="submit" value="Rechercher">
        </form>
        <a id="orgaButton" class="button" href="organiser">Créer ma balade</a>
    </section>
    <p class="isConnected"><?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {echo $_SESSION['message']; unset($_SESSION['message']);}?></p>

    <section id="rideList">
        <p>Nous t'avons trouvé <?= count($rides) ?> balades</p>
        <div>
            <?php foreach ($rides as $index => $ride) {?>
            <article>
                <a href="balades/<?= $ride->idBalade ?>"><h3>
                    <?= $ride->title?>
                </h3></a>
                <div> 
                    <p><?= substr($pseudo[$index]->pseudo, 0, 1) ?></p>
                    <p><?= $pseudo[$index]->pseudo ?></p>
                </div>
                <div>
                    <p><?= $ride->department ?></p>
                </div>
                <div>
                    <p><?= date("d/m/Y", strtotime($ride->date)) ?></p>
                    <p><?= $ride->length ?> km</p>
                </div>
                <div>
                    <p>
                        <?php 
                        if((($ride->duration)/60) < 1) {
                            echo (round(($ride->duration)%60).' min');
                        }
                        else {
                            echo (floor(($ride->duration)/60).'h'.sprintf('%02d', (round(($ride->duration)%60)))) ;
                        }
                        ?>
                    </p>
                    <p><?= $ride->difficulty ?></p>
                </div>
            </article> 
            <?php } ?>
        </div>
    </section>
</main>

<?php include ROOT.'/app/views/footer.php'; ?>