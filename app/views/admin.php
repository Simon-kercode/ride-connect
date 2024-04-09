<?php include ROOT.'/app/views/header.php'; ?>

<main id="adminPage">
<aside>
        <p><?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])) echo $_SESSION['message']; unset($_SESSION['message']); ?></p>
        <div id="profileBtn">
            <button id="usersBtn">Utilisateurs</button>
            <button id="ridesBtn">Balades</button>
            <!-- <button id="mySubscribedRidesBtn">Balades prévues</button> -->
        </div>
    </aside>
    <!-- ================ users list section ===============-->
    <section id="adminContent">
        <section id="usersList">
            <?php foreach($users as $user) : ?>
                <p>Utilisateur n°<?= $user->idUser ?></p>
                <div>
                    <p class="particle"><?=substr($user->pseudo, 0, 1)?></p>
                    <p><?=$user->pseudo ?></p>
                </div>
                <div>
                    <p><?= $user->name ?></p>
                    <p><?= $user->firstname ?></p>
                </div>
                <p><?= $user->email ?></p>
                <a href='administration/supprimer/utilisateur/<?=$user->idUser ?>'>Supprimer</a>
                <a href=''>Bannir</a>
            <?php endforeach ?>
        </section>
        <!-- ================ rides list section ===============-->
        <section id="ridesList">
            <?php if (isset($rides) && !empty($rides)) { foreach($rides as $index => $ride) : ?>
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
                        <p>RDV : <?= $ride->meetingPoint ?></p>
                        <p><?= ucfirst($ride->difficulty) ?></p>
                    </div>
                    <div>
                        <a href='administration/supprimer/balade/<?=$ride->idBalade?>'>Supprimer</a>
                    </div>
            <?php  endforeach; } ?>
        </section>
</main>

<?php include ROOT.'/app/views/footer.php'; ?>