<?php include ROOT . "/app/views/header.php"; ?>

<main id="orgaPage" class="container">
    <h1>Organiser ma balade</h1>
    <form action="" method="POST">
        <input type="text" placeholder="Un petit titre sympa">
        <div>
            <label for="date">Indique la date de ta balade</label>
            <input type="date" name="date" id="dateInput" value="">
            <label for="time">Et l'heure précise du départ</label>
            <input type="time" name="time" value="14:00">
        </div>
        <input id="startPoint" type="text" placeholder="Indique la commune de départ">
        <div>
            <label for="rdv">Lieu de rendez vous précis. Cette information ne sera visible que pour les personnes inscrites.</label>
            <input type="text" name="rdv" placeholder="Lieu de rendez-vous">
        </div>
        <div>
            <label for="">Nombre maximum de participants</label>
            <input type="number" min="2">
        </div>
        <figure>
            <figcaption>Construis maintenant ton itinéraire:</figcaption>
            <div id="map"></div>
        </figure>
        <div>
            <!--!!!!!!!!!!!!!!!!!! ajouter à la BDD et au MCD !!!!!!!!!!!!!!!!!!! -->
            <label for="precisions">Pour finir, inscris les précisions que tu souhaites apporter aux participants :</label>
            <textarea name="precisions" placeholder="Exemple : Sortie en petit groupe de 10. Allure tranquille. Pause café au lac de Guerlédan avant de reprendre la route jusque Lannion."></textarea>
        </div>
        <input type="submit" value="Enregistrer">
    </form>
</main>

<?php include ROOT . "/app/views/footer.php"; ?>