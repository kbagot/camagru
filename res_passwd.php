<?php require('connect.php');
if ($_SESSION['log'])
    header("Location: index.php");
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
    </footer>
</div>
</body>
</html>