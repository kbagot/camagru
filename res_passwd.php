<?php require('connect.php'); ?>
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
    </header>
    <section>
        <form action="php/action/res_passwd.php?hash=<?=$_GET['hash']?>" method="POST" autocomplete="on">
            <?php if ($_GET['hash']) { ?>
                <h1>Nouveau Mot de passe</h1>
                <input type="password" name="passwd" required>
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