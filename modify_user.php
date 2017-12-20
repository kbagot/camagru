<?php require('connect.php');
if (!$_SESSION['log']) {
    header('Location: index.php');
}
else{
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
        <button class="nav_b" onclick="window.location.href='php/action/logout.php'">LOGOUT</button>
    </header>
    <section>
        <form action="php/action/modify_user.php" method="POST" autocomplete="on">
            <h1>Pseudo:</h1>
            <input type="text" name="u_name" value="<?=$u_data['u_name']?>" pattern="^[A-Za-z0-9_]{1,15}$" required>
            <h1>Email</h1>
            <input type="email" value="<?=$u_data['email']?>" name="mail" required>
            <h1>Password</h1>
            <input type="password" name="passwd" pattern="^.{6,}$">
            <input type="checkbox" name="notif" <?=$u_data['notif']?> value="checked">
            <input type="submit" name="submit" value="Modify"/>
            <p><?= get_flash() ?></p>
        </form>
    </section>
    <footer>
    </footer>
</div>
</body>
</html>
