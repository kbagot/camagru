<?php require('connect.php');
error_reporting(E_ALL);
ini_set('display_errors', '1');
if (!$_SESSION['log'])
    header("Location: index.php");
?>
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
            <div class="navbox">
                <div class="navbtn">
                    <a href="library.php">Galerie</a>
                </div>
                <div class="navbtn">
                    <a href="main.php">Montage</a>
                </div>
                <div class="navbtn">
                    <a href="modify_user.php">Compte</a>
                </div>
            </div>
            <img class="logout" src="logo/logout.png" onclick="window.location.href='action/logout.php'" alt="">
    </header>
    <section>
        <div id="libimgcont">
        <?php
        if (!$_GET || !isset($_GET['page']) || !is_numeric($_GET['page']))
            $i = 0;
        else
            $i = $_GET['page'] * 9;
        $query = $DB->prepare("SELECT `img_name` FROM `img` WHERE `userid`=?");
        $query->execute(array($_SESSION['log']));
        $res = $query->fetchAll();
        for ($index = $i; $index < $i + 9; $index++) {
            if (isset($res[$index]['img_name']))
                echo '<img id="libimg" src="uploads/' . $res[$index]['img_name'] . '">';
        }
        ?>
        </div>
</section>
<footer>
    <div class="pagination">
        <?php
        $count = count($res);
        for ($index = 0; $index < ($count / 9) ; $index++) {
            echo '<a href="userlib.php?page=' . $index . '"';
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
            <img id="delimg" src="logo/delete.png">
            <button id="comm" type="submit">Publier</button>
            <a id="nolog" href="login.php">Login</a>
        </form>
    </div>
    <button id="close"></button>
</div>
<script src="js/library.js"></script>
</body>
</html>