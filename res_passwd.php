<?php require('connect.php');
if ($_SESSION['log'])
    header("Location: index.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
    <link rel="stylesheet" href="css/index.css">
    <img class="logo" src="logo/logo.png" onclick="window.location.href='index.php'" alt="">
    <div class="navbox">
        <div class="navbtn">
            <a href="library.php">Galerie</a>
        </div>
        <div class="navbtn">
            <a href="main.php">Montage</a>
        </div>
        <div class="navbtn">
            <a href="userlib.php">Photos</a>
        </div>
        <div class="navbtn">
            <a href="modify_user.php">Compte</a>
        </div>
    </div>
    <img class="logout" src="logo/logout.png" onclick="window.location.href='logout.php'" alt="">
</head>
<body>
<div class="index">
    <header>
        <img class="logo" src="uploads/logo/logo.png" alt="">
        <button class="nav_b" onclick="window.location.href='php/action/logout.php'">LOGOUT</button>
    </header>
    <section>
        <form action="php/action/res_passwd.php?hash=<?=$_GET['hash']?>" method="POST" autocomplete="on">
            <?php if ($_GET['hash']) { ?>
                <h1>Nouveau Mot de passe</h1>
                <input type="password" name="passwd" pattern="^.{6,}$" required>
            <?php } else { ?>
                <h1>Mail</h1>
                <input type="email" name="mail" required>
            <?php } ?>
            <input type="submit" name="submit" value="send"/>
            <p><?= get_flash() ?></p>
        </form>
    </section>
    <footer>
        <span class="foot">© Camagru, kbagot.</span>
    </footer>
</div>
</body>
</html>