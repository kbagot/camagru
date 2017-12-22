<?php require('connect.php');
if ($_SESSION['log'])
    header("Location: library.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
    <link rel="stylesheet" href="css/index.css">
    <title>Index</title>
</head>
<body>
<div class="index">
    <header>
        <img class="logo" src="uploads/logo/logo.png" alt="">
    </header>
    <section>
        <form action="php/action/login.php" method="POST" autocomplete="on">
            <input type="text" name="u_name" placeholder="Pseudo" required><br>
            <input type="password" name="passwd" placeholder="Mot de passe" required><br>
            <input class="formbut" type="submit" name="submit" value="Connection">
            <p class="error"><?= get_flash() ?></p>
            <a href="res_passwd.php">Mot de passe oublier</a>
        </form>
    </section>
    <footer>
        <span class="foot">© Camagru, kbagot.</span>
    </footer>
</div>
</body>
</html>
