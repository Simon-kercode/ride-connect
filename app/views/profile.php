<?php include 'app/views/header.php'; ?>

<main>
    <h1>Cette page sera ma page de profil</h1>
    <p><?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])) echo $_SESSION['message'] ?></p>
    <aside>
        <p class="particle"><?=substr($_SESSION['user']['pseudo'], 0, 1)?></p>
        <button>Mes informations</button>
        <button>Mes balades</button>
        <button>Balades prévues</button>
    </aside>
    <section id="myInfo">
        
    </section>
    <section id="myRides">

    </section>
    <section id="mySubscribedRides">

    </section>
</main>

<?php include 'app/views/footer.php'; ?>