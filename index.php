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
                <a href="login.php">Connexion</a>
            </div>
        </div>
    </header>
    <section>
        <div class="formdiv">
            <form action="php/action/register.php" method="POST" autocomplete="on">
                <input type="text" name="u_name" placeholder="Pseudo" pattern="^[A-Za-z0-9_]{1,15}$" required><br>
                <input type="email" name="mail" placeholder="E-Mail" required><br>
                <input type="password" name="passwd" placeholder="Mot de Passe" pattern="^.{6,}$" required><br>
                <p class="error"><?= get_flash() ?></p>
                <input class="formbut" type="submit" name="submit" value="S'Inscrire"/>
            </form>
        </div>
    </section>
    <footer>
        <span class="foot">© Camagru, kbagot.</span>
    </footer>
</div>
</body>
</html>




