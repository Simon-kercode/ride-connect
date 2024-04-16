<?php include 'app/views/header.php'; ?>

<main id="profilePage">
    
    <aside class="aside">
        <p class="userInfo"><?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])) echo $_SESSION['message']; unset($_SESSION['message']); ?></p>
        <p class="error"><?php if (isset($_SESSION['error']) && !empty($_SESSION['error'])) echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
        <h1>Mon profil</h1>
        <p class="particle"><?=substr($_SESSION['user']['pseudo'], 0, 1)?></p>
        <div class="asideBtn">
            <button class="button" id="myInfoBtn">Mes informations</button>
            <button class="button" id="myRidesBtn">Mes balades</button>
            <button class="button" id="mySubscribedRidesBtn">Balades prévues</button>
        </div>
    </aside>
    <section id="profileContent" class="Container">
        <!-- ================ personnal informations section ===============-->
        <section id="myInfo">
           <h2>Mes informations</h2> 
            <form action="profil" method="POST">
                <div>
                    <label for="profileEmail">Mon Email :</label>
                    <div class="flex">
                        <p><?= $_SESSION['user']['email']?></p>
                        <p><?php if(isset($emailError) && !empty($emailError)) echo $emailError ?></p>
                        <button class="button" id="emailUpdateBtn">Modifier</button>
                    </div>
                    <input class="hiddenInput" type="email" id="newEmail" name="profileEmail">
                </div>
                <hr noshade>
                <div>
                    <label for="profilePseudo">Mon pseudo :</label>
                    <div class="flex">
                        <p><?= $_SESSION['user']['pseudo']?></p>
                        <p><?php if(isset($pseudoError) && !empty($pseudoError)) echo $pseudoError ?></p>
                        <button class="button" id="pseudoUpdateBtn">Modifier</button>
                    </div>
                    <input class="hiddenInput" type="text" id="newPseudo" name="profilePseudo">
                </div>
                <hr noshade>
                <div>
                    <div>
                        <label for="profileName">Mon nom :</label>
                        <div class="flex">
                            <p><?= $_SESSION['user']['name']?></p>
                            <p><?php if(isset($nameError) && !empty($nameError)) echo $nameError ?></p>
                            <button class="button" id="nameUpdateBtn">Modifier</button>
                        </div>
                        <input class="hiddenInput" type="text" id="newName" name="profileName">
                    </div>
                    <hr noshade>
                    <div>
                        <label for="profileFirstname">Mon prénom :</label>
                        <div class="flex">
                            <p><?= $_SESSION['user']['firstname']?></p>
                            <p><?php if(isset($firstnameError) && !empty($firstnameError)) echo $firstnameError ?></p>
                            <button class="button" id="firstnameUpdateBtn">Modifier</button>
                        </div>
                        <input class="hiddenInput" type="text" id="newFirstname" name="profileFirstname">
                    </div>
                    <hr noshade>
                </div>
                <div id="passwordUpdate">
                    <button class="button" id="passwordUpdateBtn">Modifier mon mot de passe</button>
                    <?php if(isset($passwordError) && !empty($passwordError)) echo $passwordError ?>
                        <div class="hiddenInput" id="inputPasswordUpdate">
                            <input type="password" id="oldPassword" name="oldPassword" placeholder="Mot de passe actuel">
                            <input type="password" id="newPassword" name="newPassword" placeholder="Nouveau mot de passe">
                            <input type="password" id="newPasswordConfirm" name="newPasswordConfirm" placeholder="Confirmez le nouveau mot de passe">
                        </div>
                </div>
                <div id="btnContainer" class="flex">
                    <input class="formBtn" type="submit" id="saveBtn" value="Enregistrer les modifications">
                    <input class="formBtn" type="reset" id="resetBtn" value="Annuler">
                </div>
            </form>
            <button id="accountDelete" class="dangerButton deleteButton">Supprimer mon compte</button>
        </section>
        <!--================ user's rides ============ -->
        <section id="myRides">
            <h2>Mes balades</h2>
            <div class="rides">
                <div class="rideContainer">
                    <?php if(isset($rides) && !empty($rides)) {foreach ($rides as $index => $ride) :?>
                        <div class="rideItem">
                        <a href="balades/<?= $ride->idBalade ?>">
                            <article>
                                <h3><?= $ride->title?></h3>
                                <div class="flex"> 
                                    <p class="particle"><?= substr($ridesPseudos[$index][0]->pseudo, 0, 1) ?></p>
                                    <p><?= $ridesPseudos[$index][0]->pseudo ?></p>
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
                        <div class="btnRow">
                            <a class="button" href="balades/<?= $ride->idBalade?>/modifier">Modifier</a>
                            <button class="profileRideDeleteButton dangerButton" data-idBalade="<?=$ride->idBalade?>">Supprimer</button>
                            <!-- <a id="accountDeleteButton" class="dangerButton deleteButton" href="profil/supprimer/<?=$ride->idBalade?>">Supprimer</a> -->
                        </div>
                        </div>
                    <?php endforeach ?>
                </div> 
            </div>    
                <?php } else {?>
                    <p>Tu n'as pour l'instant organisé aucune balade. Tu peux aller sur la page des balades pour organiser ta propre aventure !</p>
                <?php } ?>
        </section>
        <!-- =============== user's subscribed rides ==============-->
        <section id="mySubscribedRides">
            <h2>Mes balades prévues</h2>
            <div class="rides">
                <div class="rideContainer">
                    <?php if (isset($subscribedRides) && !empty($subscribedRides)) {foreach ($subscribedRides as $index => $subscribedRide) {?>
                        <a class="rideItem" href="balades/<?= $subscribedRide->idBalade ?>">
                            <article>
                                <h3><?= $subscribedRide->title?></h3>
                                <div class="flex"> 
                                    <p class="particle"><?= substr($subscribedRidesPseudos[$index][0]->pseudo, 0, 1) ?></p>
                                    <p><?= $subscribedRidesPseudos[$index][0]->pseudo ?></p>
                                </div>
                                <div class="flex location">
                                    <img src="public/images/icons/location.svg" alt="Croix de localisation">
                                    <p><?= $subscribedRide->department ?></p>
                                </div>
                                <div class="flexSpace">
                                    <div class="flex">
                                        <img src="public/images/icons/calendar.svg" alt="Calendrier">
                                        <p><?= date("d/m/Y", strtotime($subscribedRide->date)) ?></p>
                                    </div>
                                    <div class="flex">
                                        <img src="public/images/icons/road.svg" alt="Route">
                                        <p><?= $subscribedRide->length ?> km</p>
                                    </div>
                                </div>
                                <div class="flexSpace">
                                    <div class="flex">
                                        <img src="public/images/icons/clock.svg" alt="Horloge">
                                        <p>
                                            <?php 
                                            if((($subscribedRide->duration)/60) < 1) {
                                                echo ((round($subscribedRide->duration)%60).' min');
                                            }
                                            else {
                                                echo (floor(($subscribedRide->duration)/60).'h'.sprintf('%02d', (round($subscribedRide->duration)%60))) ;
                                            }
                                            ?>
                                        </p>
                                    </div>
                                    <div class="flex">
                                        <img src="public/images/icons/level.svg" alt="Barres indiquant différents niveaux">
                                        <p><?= ucfirst($subscribedRide->difficulty) ?></p>
                                    </div>
                                </div>
                                <div class="rdv">
                                    <p>RDV : <?= $subscribedRide->meetingPoint ?></p>
                                </div>
                            </article>
                        </a> 
                    <?php }} else { ?>   
                        <p>Aucune balade de prévue ! Tu peux visiter la liste des balades pour trouver ton bonheur !</p></p>    
                    <?php } ?>  
            
                </div>
            </div>
        </section>
    </section>
</main>

<?php include 'app/views/footer.php'; ?>