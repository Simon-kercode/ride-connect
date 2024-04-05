<?php include ROOT.'/app/views/header.php'; ?>

<main id="rideDetailsPage">

    <h2><?= $ride->title ?></h2>
    <figure>
        <div id="mapDetails"></div>
    </figure>
    <div class="container">
        <div class="flexBetween">
            <div class="flex">
                <p class="bold particle"><?= substr($pseudo[0]->pseudo, 0, 1) ?></p>
                <p><?= $pseudo[0]->pseudo ?></p>
            </div>
            <div>
                <p>Date : <span class="bold"><?= $ride->date ?></span></p>
                <p>Départ à : <span class="bold"><?= $ride->time ?></span></p>
            </div>
        </div>
        <p id="startEnd"><?= $ride->startPoint ?> --> <?= $ride->arrival ?></p>
        <div id="rideInfos" class="flexBetween">
            <p>Distance<br><span class="bold"><?= $ride->length ?> km</span></p>
            <p>Durée<br>
                <span class="bold"> 
                    <?php 
                        if((($ride->duration)/60) < 1) {
                            echo (round(($ride->duration)%60).' min');
                        }
                        else {
                            echo (floor(($ride->duration)/60).'h'.sprintf('%02d', (round(($ride->duration)%60)))) ;
                        }
                    ?>
                </span>
            </p>
            <p>Niveau<br><span class="bold"><?= ucfirst($ride->difficulty) ?></span></p>
        </div>
        <p>Inscrits : <?= $partQuantity ?>/<?= $ride->partNumber ?></p>
        <div id="preciGPS">
            <p><?= $ride->precisions ?></p>
            <div id="gps"></div>
        </div>
    </div>
    <a class="button" href="balades/<?=$ride->idBalade?>/participer">Je participe !</a>
    <p class="isConnected"><?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {echo $_SESSION['message']; unset($_SESSION['message']);}?></p>


    <script>document.addEventListener('DOMContentLoaded', function(event) {
        createRoute(<?= $ride->waypoints?>)
    })</script>
</main>

<?php include ROOT.'/app/views/footer.php'; ?>