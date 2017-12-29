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
        <?php require('connect.php');
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        if (isset($_SESSION['log'])) { ?>
            <div class="navbox">
                <div class="navbtn">
                    <a href="userlib.php">Photos</a>
                </div>
                <div class="navbtn">
                    <a href="main.php">Montage</a>
                </div>
                <div class="navbtn">
                    <a href="modify_user.php">Compte</a>
                </div>
            </div>
            <img class="logout" src="logo/logout.png" onclick="window.location.href='php/action/logout.php'" alt="">
        <?php } ?>
</header>
<section>
    <div id="libimgcont">
        <?php
        if (!$_GET || !isset($_GET['page']) || !is_numeric($_GET['page']))
            $i = 0;
        else
            $i = $_GET['page'] * 9;
        $reverse = scandir('uploads/', SCANDIR_SORT_DESCENDING);
        for ($index = $i; $index < $i + 9; $index++) {
            if (isset($reverse[$index + 2]))
                echo '<img id="libimg" src="uploads/' . $reverse[$index] . '">';
        }
        ?>
    </div>
</section>
<footer>
    <div class="pagination">
        <?php
        $count = count($reverse) - 2;
        for ($index = 0; $index < ($count / 9); $index++) {
            echo '<a href="library.php?page=' . $index . '"';
            if ($i / 9 == $index)
                echo ' class="active"';
            echo '>' . ($index + 1) . '</a>';
        }
        ?>
    </div>
</footer>
</div>
<div id="displayimg">
    <div id="content">
        <img id="showimg">
        <div id="showcomm">
        </div>
        <form action="" onsubmit="sendCom(event)">
            <textarea autofocus name="comm" id="combox" placeholder="Commentaire ..." maxlength="255"></textarea>
            <a id="nolog" href="login.php"></a>
            <img id="like" src="logo/like.png">
            <button id="comm" type="submit">Publier</button>
        </form>
    </div>
    <button id="close"></button>
</div>
<script src="js/library.js"></script>
</body>
</html>
