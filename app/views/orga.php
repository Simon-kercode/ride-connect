<?php include ROOT . "/app/views/header.php"; ?>

<main id="orgaPage" class="container">
    <h1>Organiser ma balade</h1>
    <form action="" method="POST" id="orgaForm">
        <div>
            <label for="title">Donne un petit titre sympa *</label>
            <input name="title" type="text" placeholder="ex: Visite aux anciens de Béganne">
        </div>
        <div>
            <label for="date">Indique la date de ta balade *</label>
            <input type="date" name="date" id="dateInput" value="">
            <label for="time">Et l'heure précise du départ *</label>
            <input type="time" name="time" value="14:00">
        </div>
        <label for="startPoint">Indique la commune de départ *</label>
        <input name="startPoint" id="startPoint" type="text" placeholder="ex: Vannes">
        <div>
            <label for="meetingPoint">Lieu de rendez vous précis. Cette information ne sera visible que pour les personnes inscrites. *</label>
            <input type="text" name="meetingPoint" placeholder="ex: Station essence Leclerc Vannes">
        </div>
        <div>
            <label for="partNumber">Nombre maximum de participants (laisse ce champ vide si tu n'a pas de limite de nombre)</label>
            <input name="partNumber" type="number" min="2">
        </div>
        <figure>
            <figcaption>Construis maintenant ton itinéraire *:</figcaption>
            <div id="map"></div>
        </figure>
        <div>
            <label for="difficulty">Estime la difficulté du parcours *</label>
            <select name="difficulty" id="difficulty">
                <option value="">Sélectionne une difficulté</option>
                <option value="debutant">Débutant</option>
                <option value="intermediaire">Intermédiaire</option>
                <option value="confirme">Confirmé</option>
            </select>
        </div>
        <div>
            <!--!!!!!!!!!!!!!!!!!! ajouter à la BDD et au MCD !!!!!!!!!!!!!!!!!!! -->
            <label for="precisions">Pour finir, inscris les précisions que tu souhaites apporter aux participants :</label>
            <textarea name="precisions" placeholder="Exemple : Sortie en petit groupe de 10. Allure tranquille. Pause café au lac de Guerlédan avant de reprendre la route jusque Lannion."></textarea>
        </div>
        <p>* : Champs obligatoires</p>
        <input type="submit" value="Enregistrer">
    </form>
    <p><?php if(isset($error)) echo $error ?></p>
</main>

<?php include ROOT . "/app/views/footer.php"; ?>