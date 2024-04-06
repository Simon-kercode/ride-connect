<?php include 'app/views/header.php'; ?>

<main id="profilePage">
    
    <aside>
        <p><?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])) echo $_SESSION['message'] ?></p>
        <p class="particle"><?=substr($_SESSION['user']['pseudo'], 0, 1)?></p>
        <div id="profileBtn">
            <button id="myInfoBtn">Mes informations</button>
            <button id="myRidesBtn">Mes balades</button>
            <button id="mySubscribedRidesBtn">Balades prévues</button>
        </div>
    </aside>
    <section>
        <section id="myInfo">
            <form action="">
                <div>
                    <label for="profileEmail">Mon Email</label>
                    <input type="email" id="profileEmail" name="profileEmail" value="<?= $_SESSION['user']['email']?>">
                </div>
                <div>
                    <label for="profilePseudo">Mon pseudo</label>
                    <input type="text" id="profileEmail" name="profilePseudo" value="<?= $_SESSION['user']['pseudo']?>">
                </div>
                <div>
                    <label for="profileName">Mon nom</label>
                    <input type="text" id="profileName" name="profileName" value="<?= $_SESSION['user']['name']?>">
                    <label for="profileFirstname">Mon prénom</label>
                    <input type="text" id="profileFirstname" name="profileFirstname" value="<?= $_SESSION['user']['firstname']?>">
                </div>
                <div>
                    <button id="passwordUpdateBtn">Modifier mon mot de passe</button>
                    <input type="password" id="oldPassword" name="oldPassword">
                    <input type="password" id="newPassword" name="newPassword">
                    <input type="password" id="newPasswordConfirm" name="newPasswordConfirm">
                </div>
                <div>
                    <input type="submit" value="Enregistrer les modifications">
                    <input type="reset" value="Annuler">
                </div>
            </form>
        </section>
        <section id="myRides">
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
                        <p>RDV : <?= $ride->meetingPoint ?></p>
                        <p><?= ucfirst($ride->difficulty) ?></p>
                    </div>
                </article> 
                <?php } ?>
        </section>
        <section id="mySubscribedRides">
        <?php foreach ($subscribedRides as $index => $subscribedRide) {?>
                <article>
                    <a href="balades/<?= $subscribedRide->idBalade ?>"><h3>
                        <?= $subscribedRide->title?>
                    </h3></a>
                    <div> 
                        <p><?= substr($pseudo[$index]->pseudo, 0, 1) ?></p>
                        <p><?= $pseudo[$index]->pseudo ?></p>
                    </div>
                    <div>
                        <p><?= $subscribedRide->department ?></p>
                    </div>
                    <div>
                        <p><?= date("d/m/Y", strtotime($subscribedRide->date)) ?></p>
                        <p><?= $subscribedRide->length ?> km</p>
                    </div>
                    <div>
                        <p>
                            <?php 
                            if((($subscribedRide->duration)/60) < 1) {
                                echo (round(($subscribedRide->duration)%60).' min');
                            }
                            else {
                                echo (floor(($subscribedRide->duration)/60).'h'.sprintf('%02d', (round(($subscribedRide->duration)%60)))) ;
                            }
                            ?>
                        </p>
                        <p>RDV : <?= $subscribedRide->meetingPoint ?></p>
                        <p><?= ucfirst($subscribedRide->difficulty) ?></p>
                    </div>
                </article> 
                <?php } ?>         
        </section>
    </section>
</main>

<?php include 'app/views/footer.php'; ?>