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
            <p>Durée<br><span class="bold"><?= $ride->duration ?></span></p>
            <p>Niveau<br><span class="bold"><?= ucfirst($ride->difficulty) ?></span></p>
        </div>
        <p>Inscrits : /<?= $ride->partNumber ?></p>
        <div id="gps"></div>
        <p><?= $ride->precisions ?></p>
    </div>
    <button class="button">Je m'inscris !</button>



    <script>document.addEventListener('DOMContentLoaded', function(event) {
        createRoute(<?= $ride->waypoints?>)
    })</script>
</main>

<?php include ROOT.'/app/views/footer.php'; ?>