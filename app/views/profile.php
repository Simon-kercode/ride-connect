<?php include 'app/views/header.php'; ?>

<main id="profilePage">
    
    <aside>
        <p><?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])) echo $_SESSION['message']; unset($_SESSION['message']); ?></p>
        <p class="particle"><?=substr($_SESSION['user']['pseudo'], 0, 1)?></p>
        <div id="profileBtn">
            <button id="myInfoBtn">Mes informations</button>
            <button id="myRidesBtn">Mes balades</button>
            <button id="mySubscribedRidesBtn">Balades prévues</button>
        </div>
    </aside>
    <!-- ================ personnal informations section ===============-->
    <section id="profileContent">
        <section id="myInfo">
            <form action="profil" method="POST">
                <div>
                    <label for="profileEmail">Mon Email</label>
                    <div>
                        <p><?= $_SESSION['user']['email']?></p>
                        <p><?php if(isset($emailError) && !empty($emailError)) echo $emailError ?></p>
                        <button id="emailUpdateBtn">Modifier</button>
                    </div>
                    <input class="hiddenInput" type="email" id="newEmail" name="profileEmail">
                </div>
                <div>
                    <label for="profilePseudo">Mon pseudo</label>
                    <div>
                        <p><?= $_SESSION['user']['pseudo']?></p>
                        <?php if(isset($pseudoError) && !empty($pseudoError)) echo $pseudoError ?>
                        <button id="pseudoUpdateBtn">Modifier</button>
                    </div>
                    <input class="hiddenInput" type="text" id="newPseudo" name="profilePseudo">
                </div>
                <div>
                    <div>
                        <label for="profileName">Mon nom</label>
                        <div>
                            <p><?= $_SESSION['user']['name']?></p>
                            <?php if(isset($nameError) && !empty($nameError)) echo $nameError ?>
                            <button id="nameUpdateBtn">Modifier</button>
                        </div>
                        <input class="hiddenInput" type="text" id="newName" name="profileName">
                    </div>
                    <div>
                        <label for="profileFirstname">Mon prénom</label>
                        <div>
                            <p><?= $_SESSION['user']['firstname']?></p>
                            <?php if(isset($firstnameError) && !empty($firstnameError)) echo $firstnameError ?>
                            <button id="firstnameUpdateBtn">Modifier</button>
                        </div>
                        <input class="hiddenInput" type="text" id="newFirstname" name="profileFirstname">
                    </div>
                </div>
                <div id="passwordUpdate">
                    <button id="passwordUpdateBtn">Modifier mon mot de passe</button>
                    <?php if(isset($passwordError) && !empty($passwordError)) echo $passwordError ?>
                        <div class="hiddenInput" id="inputPasswordUpdate">
                            <input type="password" id="oldPassword" name="oldPassword" placeholder="Mot de passe actuel">
                            <input type="password" id="newPassword" name="newPassword" placeholder="Nouveau mot de passe">
                            <input type="password" id="newPasswordConfirm" name="newPasswordConfirm" placeholder="Retapez votre nouveau mot de passe">
                        </div>
                </div>
                <div>
                    <input type="submit" value="Enregistrer les modifications">
                    <input type="reset" id="resetBtn" value="Annuler">
                </div>
                <div><a href="profil/supprimer">Supprimer mon compte</a></div>
            </form>
        </section>
        <!--================ user's rides ============ -->
        <section id="myRides">
        <?php if(isset($rides) && !empty($rides)) {foreach ($rides as $index => $ride) {?>
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
                        <a href="balades/<?= $ride->idBalade?>/modifier">Modifier</a>
                        <a href="profil/supprimer/<?=$ride->idBalade?>">Supprimer</a>
                    </div>
                </article> 
                <?php }} else {?>
                    <p>Tu n'as pour l'instant organisé aucune balade. Tu peux aller sur la page des balades pour organiser ta propre aventure !</p>
                <?php } ?>
        </section>
        <!-- =============== user's subscribed rides ==============-->
        <section id="mySubscribedRides">
        <?php if (isset($subscribedRides) && !empty($subscribedRides)) {foreach ($subscribedRides as $index => $subscribedRide) {?>
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
                    <div>
                    </div>
                </article> 
                <?php }} else { ?>   
                    <p>Aucune balade de prévue ! Tu peux visiter la liste des balades pour trouver ton bonheur !</p></p>    
                <?php } ?>  
        </section>
    </section>
</main>

<?php include 'app/views/footer.php'; ?>