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
        <form action="php/action/register.php" method="POST" autocomplete="on">
            <h1>Pseudo:</h1>
            <input type="text" name="u_name" pattern="^[A-Za-z0-9_]{1,15}$" required>
            <h1>Email</h1>
            <input type="email" name="mail" required>
            <h1>Password</h1>
            <input type="password" name="passwd" pattern="^.{6,}$" required>
            <input type="submit" name="submit" value="Register"/>
            <p><?= get_flash() ?></p>
        </form>
    </section>
    <footer>
    </footer>
</div>
</body>
</html>




