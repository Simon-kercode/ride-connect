<?php include ROOT . "/app/views/header.php"; ?>

<main>
    <section>
        <div id="welcome">
            <?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {echo $_SESSION['message']; unset($_SESSION['message']);} ?>
            <h1>Rouler,<br> ensemble</h1>
            <input id="welcomeSearch" type="search" name="search" placeholder="Recherche par département, région...">
        </div>
    </section>
</main>

<?php include ROOT . "/app/views/footer.php"; ?>