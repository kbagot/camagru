<?php require('connect.php');
if ($_SESSION['log'])
    header("Location: index.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Pacifico">
</head>
<body>
<div class="index">
    <header>
        <img class="logo" src="logo/logo.png" onclick="window.location.href='index.php'" alt="">
        <div class="navbox">
            <div class="navbtn">
                <a href="library.php">Galerie</a>
            </div>
        </div>
    </header>
    <section>
        <div class="formdiv">
            <form action="action/res_passwd.php?hash=<?= $_GET['hash'] ?>" method="POST" autocomplete="on">
                <?php if ($_GET['hash']) { ?>
                    <input type="password" name="passwd" placeholder="Nouveau Mot de passe" pattern="^.{6,}$" required>
                <?php } else { ?>
                    <input type="email"  placeholder="E-Mail" name="mail" required>
                <?php } ?>
                <input class="formbut" type="submit" name="submit" value="send"/>
                <p class="error"><?= get_flash() ?></p>
            </form>
        </div>
    </section>
    <footer>
        <span class="foot">© Camagru, kbagot.</span>
    </footer>
</div>
</body>
</html>