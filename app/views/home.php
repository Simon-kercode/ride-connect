<?php include ROOT . "/app/views/header.php"; ?>

<main>
    <section>
        <div id="welcome">
            <?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {echo $_SESSION['message']; unset($_SESSION['message']);} ?>
            <h1>Rouler,<br> ensemble</h1>
            <form action="balades" method="POST">
                <input id="welcomeSearch" type="search" name="rideSearch" placeholder="Recherche par département, région...">
            </form>
        </div>
    </section>
</main>

<?php include ROOT . "/app/views/footer.php"; ?>