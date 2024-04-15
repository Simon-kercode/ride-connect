<?php include ROOT.'/app/views/header.php'; ?>

<main id="adminPage">
<aside class="aside">
    <h1>Administration</h1>
    <p class="userInfo"><?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])) echo $_SESSION['message']; unset($_SESSION['message']); ?></p>
    <p class="error"><?php if (isset($_SESSION['error']) && !empty($_SESSION['error'])) echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <div class="asideBtn">
        <button class="button" id="usersBtn">Utilisateurs</button>
        <button class="button" id="ridesBtn">Balades</button>
        <button class="button" id="messagesBtn">Messages</button>
        <!-- <button id="mySubscribedRidesBtn">Balades prévues</button> -->
    </div>
</aside>
    <!-- ================ users list section ===============-->
    <section id="adminContent"> 
        <section id="usersList">
           <h2>Liste des utilisateurs</h2>
            <div id="usersGrid">
                <?php foreach($users as $user) : ?>
                    <article id="userContainer">
                        <div>
                            <p>Utilisateur n°<?= $user->idUser ?></p>
                        </div>
                        <div class="flex">
                            <p class="particle"><?=substr($user->pseudo, 0, 1)?></p>
                            <p><?=$user->pseudo ?></p>
                        </div>
                        <div>
                            <p>Nom : <?= $user->name ?></p>
                            <p>Prénom : <?= $user->firstname ?></p>
                        </div>
                        <div>
                            <p><?= $user->email ?></p>
                        </div>
                        <div>
                            <p>
                                Admin : <?php if ($user->isAdmin == 1) echo 'Oui'; else echo 'Non' ?>
                            </p>
                        </div>
                        <div class="btnRow">
                            <a class="dangerButton" href='administration/supprimer/utilisateur/<?=$user->idUser ?>'>Supprimer</a>
                            <?php if($user->isAdmin == 1) { ?>
                                <a class="dangerButton" href='administration/revokeAdmin/utilisateur/<?=$user->idUser ?>'> Retirer administrateur</a>
                            <?php } else { ?>
                                <a class="dangerButton" href='administration/setAdmin/utilisateur/<?=$user->idUser ?>'> Passer administrateur</a>
                            <?php } ?>
                        </div>
                    </article>  
                <?php endforeach ?>
            </div>   
        </section>
        <!-- ================ rides list section ===============-->
        <section id="ridesList">
            <h2>Liste des balades</h2>
            <div class="rides">
                <div class="rideContainer">
                    <?php if (isset($rides) && !empty($rides)) : foreach($rides as $index => $ride) : ?>
                        <div class="rideItem">
                            <a href="balades/<?= $ride->idBalade ?>">
                                <article>
                                    <p> Balade n° <?= $ride->idBalade ?></p>
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
                                                    echo (round(($ride->duration)%60).' min');
                                                }
                                                else {
                                                    echo (floor(($ride->duration)/60).'h'.sprintf('%02d', (round($ride->duration)%60))) ;
                                                }
                                                ?>
                                            </p>
                                        </div>
                                        <div class="flex">
                                            <img src="public/images/icons/level.svg" alt="Barres indiquant différents niveaux">
                                            <p><?= ucfirst($ride->difficulty) ?></p>
                                        </div>
                                    </div>       
                                    <div class="rdv">
                                        <p>RDV : <?= $ride->meetingPoint ?></p> 
                                    </div>    
                                    
                                </article>
                            </a>
                            <div>
                                <a class="dangerButton" href='administration/supprimer/balade/<?=$ride->idBalade?>'>Supprimer</a>
                            </div>
                        </div>
                    <?php  endforeach ?>
                    <?php endif ?>
                </div>
            </div>
        </section>
        <!--=================== messages section ============== -->
        <section id="messagesList">
            <h2>Messages Reçus</h2>
            <?php if (isset($messages) && !empty($messages)) : foreach($messages as $message) : ?>
            <div>
                <p>Date d'envoi : <?= date('d/m/Y', strtotime($message->sendDate))?></p>
                <p>Expéditeur : <?= $message->email ?></p>
                <p>Objet : <?= $message->object ?></p>
                <p><?= $message->message ?></p>
                <?php endforeach ?>
                <?php endif ?>
            </div>
        </section>
    </section>
</main>

<?php include ROOT.'/app/views/footer.php'; ?>