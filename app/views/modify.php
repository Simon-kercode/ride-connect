<?php include ROOT.'/app/views/header.php' ?>

<main id="modifyPage" class="container">
    <h1>Modifier ma balade</h1>
    <form action='balades/<?=$ride->idBalade ?>/modifier' method="POST" id="modifyForm">
        <div>
            <label for="title">Donne un petit titre sympa *</label>
            <input name="title" type="text" placeholder="ex: Visite aux anciens de Béganne" value="<?= $ride->title?>">
        </div>
        <div id="dateTimeModify" class="flexSpace dateTime">
            <label for="dateInput">Indique la date et l'heure de ta balade *</label>
            <div class="flexSpace">
                <input type="date" name="date" id="dateInputModify" value="<?=$ride->date ?>">
                <input type="time" name="time" value="<?= substr($ride->time, 0, 5)?>">
            </div>
        </div>
        <div>
            <label for="startPoint">Indique la commune de départ *</label>
            <input name="startPoint" id="startPointModify" type="text" placeholder="ex: Vannes" value="<?=$ride->startPoint ?>">
        </div>
        <div>
            <label for="meetingPoint">Lieu de rendez vous précis. Cette information ne sera visible que pour les personnes inscrites. *</label>
            <input type="text" name="meetingPoint" id="meetingPointModify" placeholder="ex: Station essence Leclerc Vannes" value="<?= $ride->meetingPoint ?>">
        </div>
        <div>
            <label for="partNumber">Nombre maximum de participants (laisse ce champ vide si tu n'a pas de limite de nombre)</label>
            <input name="partNumber" id="partNumberModify" type="number" min="2" value="<?=$ride->partNumber?>">
        </div>
        <figure>
            <figcaption>Construis maintenant ton itinéraire *:</figcaption>
            <div id="mapModify" class="map"></div>
        </figure>
        <div>
            <label for="difficulty">Estime la difficulté du parcours *</label>
            <select name="difficulty" id="difficultyModify">
                <option value="">Sélectionne une difficulté</option>
                <option value="débutant" <?php if ($ride->difficulty === 'débutant') echo 'selected'; ?>>Débutant</option>
                <option value="intermédiaire" <?php if ($ride->difficulty === 'intermédiaire') echo 'selected'; ?>>Intermédiaire</option>
                <option value="confirmé" <?php if ($ride->difficulty === 'confirmé') echo 'selected'; ?>>Confirmé</option>
            </select>
        </div>
        <div class="precisionsContainer">
            <label for="precisions">Pour finir, inscris les précisions que tu souhaites apporter aux participants :</label>
            <textarea name="precisions" id="precisionsModify" placeholder="Exemple : Sortie en petit groupe de 10. Allure tranquille. Pause café au lac de Guerlédan avant de reprendre la route jusque Lannion."><?= $ride->precisions ?></textarea>
        </div>
        <div hidden>
            <input type="text" name="pointsInfos" id="pointsInfosModify">
            <input type="text" name="routeInfos" id="routeInfosModify">
            <input type="text" name="waypoints" id="waypointsModify" value="<?= $ride->waypoints ?>">
           
        </div>
        <p>* : Champs obligatoires</p>
        <p class="error"><?php if(isset($error) && !empty($error)) echo $error ?></p>
        <input type="submit"class="formBtn" value="Enregistrer">
    </form>
    
    <script>document.addEventListener('DOMContentLoaded', function(event) {
        displayInitial(<?= $ride->waypoints?>)
    })</script>
</main>

<?php include ROOT.'/app/views/footer.php' ?>