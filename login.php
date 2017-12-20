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
    </header>
    <section>
        <form action="php/action/login.php" method="POST" autocomplete="on">
            <h1>Pseudo:</h1>
            <input type="text" name="u_name" required>
            <h1>Password</h1>
            <input type="password" name="passwd" required>
            <input type="submit" name="submit" value="log"/>
            <p><?= get_flash() ?></p>
            <a href="res_passwd.php">Mot de passe oublier</a>
        </form>
    </section>
    <footer>
    </footer>
</div>
</body>
</html>
