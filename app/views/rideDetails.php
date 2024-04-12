<?php include ROOT.'/app/views/header.php'; ?>

<main id="rideDetailsPage">
    <h2><?= $ride->title ?></h2>
    <figure>
        <div id="mapDetails"></div>
    </figure>
    <div class="reductContainer">
        <div class="flexSpace">
            <div id="creator" class="flex">
                <p class="bold particle"><?= substr($pseudo[0]->pseudo, 0, 1) ?></p>
                <p id="creatorPseudo"><?= $pseudo[0]->pseudo ?></p>
            </div>
            <div>
                <!-- display date to format dd/mm/yyyy. strtotime transform string into timestamp (int required)-->
                <p>Date : <span class="bold"><?= date("d/m/Y", strtotime($ride->date)) ?></span></p>
                <!-- display time without seconds (hh:mm) -->
                <p>Départ à : <span class="bold"><?= substr($ride->time, 0, 5) ?></span></p>
            </div>
        </div>
        <p id="startEnd"><?= $ride->startPoint ?> --> <?= $ride->arrival ?></p>
        <div id="rideInfos" class="flexSpace">
            <p>Distance<br><span class="bold"><?= $ride->length ?> km</span></p>
            <p>Durée<br>
                <span class="bold"> 
                    <?php 
                        if((($ride->duration)/60) < 1) {
                            echo ((round($ride->duration)%60).' min');
                        }
                        else {
                            echo (floor(($ride->duration)/60).'h'.sprintf('%02d', (round($ride->duration)%60))) ;
                        }
                    ?>
                </span>
            </p>
            <p>Niveau<br><span class="bold"><?= ucfirst($ride->difficulty) ?></span></p>
        </div>
        <p id="participants">Inscrits : <span class="bold"><?= $partQuantity ?>/<?= $ride->partNumber ?></span></p>
        <div id="preciGPS" class="flexSpace">
            <p><?= $ride->precisions ?></p>
            <?php if (isset($participation) && $participation) { ?>
                <div id="gps">
                    <div>
                        <button id="displayGpsBtn" class="button">Voir le GPS</button>
                        <button id="hideGpsBtn" class="button">Cacher</button>
                    </div>
                    <div id="gpsContainer"></div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div id="actionLinks">
        <?php 
            if (isset($_SESSION['user']) && !empty($_SESSION['user']['idUser']) && ($ride->idUser === $_SESSION['user']['idUser'])) : ?>
            <a class="button" href="balades/<?=$ride->idBalade?>/modifier">Modifier</a>
        <?php 
            elseif (isset($_SESSION['user']) && !empty($_SESSION['user']['idUser']) && !$participation) :?>
        <a class="button" href="balades/<?=$ride->idBalade?>/participer">Je participe !</a>
        <?php endif ?>
        <p class="isConnected"><?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {echo $_SESSION['message']; unset($_SESSION['message']);}?></p>
    </div>


    <script>document.addEventListener('DOMContentLoaded', function(event) {
        createRoute(<?= $ride->waypoints?>)
    })</script>
</main>

<?php include ROOT.'/app/views/footer.php'; ?>