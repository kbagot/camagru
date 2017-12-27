<?php require('connect.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Pacifico">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<div class="index">
    <header>
        <img class="logo" src="logo/logo.png" onclick="window.location.href='index.php'" alt="">
    </header>
    <section>
        <p class="navmsg"> <?=get_flash()?> </p>
    </section>
    <footer>
        <span class="foot">© Camagru, kbagot.</span>
    </footer>
</div>
</body>
</html>
<?php header( "Refresh:2; url=index.php", true, 303);?>
