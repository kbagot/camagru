<?php require('connect.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<div class="index">
    <header>
    </header>
    <section>
        <p> <?=get_flash()?> </p>
    </section>
    <footer>
    </footer>
</div>
</body>
</html>
<?php header( "Refresh:2; url=index.php", true, 303);?>
