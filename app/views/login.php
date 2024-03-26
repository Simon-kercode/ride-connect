<?php include ROOT.'/app/views/header.php'; ?>

<form action="connexion" method = "post">
    <div>
        <label for="email">Email</label>
        <input type="text" name="email">
    </div>
    <div>
        <label for="password">MDP</label>
        <input type="password" name="password">
    </div>
    <p><?php if(!empty($_SESSION['error'])) echo $_SESSION['error'] ?></p>
    <div>
        <input type="submit" value="Connexion">
    </div>
</form>

<?php include ROOT.'/app/views/footer.php'; ?>