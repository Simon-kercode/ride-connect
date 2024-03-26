<?php include ROOT.'/app/views/header.php'; ?>

<h1>Inscription</h1>
<form action="inscription" method="post">
    <div>
        <label for="email">Email</label>
        <input type="text" name="email">
    </div>
    <div>
        <label for="mdp">MDP</label>
        <input type="password" name="password">
    </div>
    <div>
        <label for="pseudo">pseudo</label>
        <input type="text" name="pseudo">
    </div>
    <div>
        <label for="name">Nom</label>
        <input type="text" name="name">
    </div>
    <div>
        <label for="firstname">Prénom</label>
        <input type="text" name="firstname">
    </div>
    <p><?php if(isset($error) && !empty($error)) echo $error ?></p>
    <div>
        <input type="submit" value="Inscription">
    </div>
</form>

<?php include ROOT.'/app/views/footer.php'; ?>