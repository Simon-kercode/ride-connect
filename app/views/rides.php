<?php include ROOT.'/app/views/header.php'; ?>

<main>
    <h1>Trouver ma balade</h1>
    <section>
        <input type="search" name="rideSearch" placeholder="Recherche par département ou région">
        <button>Rechercher</button>
        <a class="button" href="organiser">Créer ma balade</a>
    </section>
    <section id="rideList">
        <p>Nous t'avons trouvé X balades</p>
        <div>
            <?php foreach($rides as $ride)  echo bloup?>
            <article>
                <div>
                    
                </div>
            </article> 
            <!-- <php } ?> -->
        </div>
    </section>
</main>

<?php include ROOT.'/app/views/footer.php'; ?>