<?php require('connect.php');
if (!$_SESSION['log']) {
    header('Location: index.php');
} else {
    $query = $DB->prepare("SELECT `u_name`, `email`, `passwd`, `vhash`, `notif` FROM `users` WHERE uid=?");
    $query->execute(array($_SESSION['log']));
    $u_data = $query->fetch();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
    <link rel="stylesheet" href="css/index.css">
    <title>Modify User</title>
</head>
<body>
<div class="index">
    <header>
        <a href="index.php">
            <img class="logo" src="uploads/logo/logo.png" alt="">
        </a>
        <a class="navbtn" href="Library.php">Mur</a>
        <a class="navbtn" href="main.php">Montage</a>
        <a class="navbtn" href="userlib.php">Mes Photos</a>
        <a class="navbtn" href="modify_user.php">Mon Compte</a>
        <a class="navbtn" href="php/action/logout.php">Deconnecter</a>
    </header>
    <section>
        <div class="formdiv">
            <form action="php/action/modify_user.php" method="POST" autocomplete="on">
                <input type="text" name="u_name" value="<?= $u_data['u_name'] ?>" placeholder="Pseudo"
                       pattern="^[A-Za-z0-9_]{1,15}$" required><br>
                <input type="email" value="<?= $u_data['email'] ?>" placeholder="E-Mail" name="mail" required><br>
                <input type="password" name="passwd" placeholder="Mot de passe" pattern="^.{6,}$"><br>
                E-Mail Notifications:<input id="checkbt" type="checkbox" name="notif" <?= $u_data['notif'] ?>
                                            value="checked"><br>
                <p class="error"><?= get_flash() ?></p>
                <input class="formbut" type="submit" name="submit" value="Modifier"/>
            </form>
        </div>
    </section>
    <footer>
        <span class="foot">© Camagru, kbagot.</span>
    </footer>
</div>
</body>
</html>
