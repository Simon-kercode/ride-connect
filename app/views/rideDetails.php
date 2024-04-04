<?php include ROOT.'/app/views/header.php'; ?>

<main id="rideDetailsPage">

    <h2><?= $ride->title ?></h2>
    <figure>
        <div id="mapDetails"></div>
    </figure>
    <div>
        <div>
            <?= substr($pseudo[0]->pseudo, 0, 1) ?>
        </div>
    </div>



    <script>document.addEventListener('DOMContentLoaded', function(event) {
        createRoute(<?= $ride->waypoints?>)
    })</script>
</main>

<?php include ROOT.'/app/views/footer.php'; ?>