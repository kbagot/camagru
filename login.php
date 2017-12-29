<?php require('connect.php');
if ($_SESSION['log'])
    header("Location: library.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Pacifico">
    <title>Index</title>
</head>
<body>
<div class="index">
    <header>
        <img class="logo" src="logo/logo.png" onclick="window.location.href='index.php'" alt="">
        <div class="navbox">
            <div class="navbtn">
                <a href="library.php">Galerie</a>
            </div>
            <div class="navbtn">
                <a href="index.php">S'inscrire</a>
            </div>
        </div>
    </header>
    <section>
        <div class="formdiv">
            <form action="php/action/login.php" method="POST" autocomplete="on">
                <input type="text" name="u_name" placeholder="Pseudo" required><br>
                <input type="password" name="passwd" placeholder="Mot de passe" required><br>
                <input class="formbut" type="submit" name="submit" value="Connection">
                <p class="error"><?= get_flash() ?></p>
                <a href="res_passwd.php">Mot de passe oublier ?</a>
            </form>
        </div>
    </section>
    <footer>
        <span class="foot">© Camagru, kbagot.</span>
    </footer>
</div>
</body>
</html>
