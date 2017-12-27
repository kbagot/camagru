<?php
require "connect.php"; //database conection
error_reporting(E_ALL);
ini_set('display_errors', '1');
if (!$_SESSION['log'])
    header("Location: index.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Pacifico">
</head>
<body>
<div class="main">
    <header>
        <img class="logo" src="logo/logo.png" onclick="window.location.href='index.php'" alt="">
        <div class="navbox">
            <div class="navbtn">
                <a href="library.php">Galerie</a>
            </div>
            <div class="navbtn">
                <a href="userlib.php">Photos</a>
            </div>
            <div class="navbtn">
                <a href="modify_user.php">Compte</a>
            </div>
        </div>
        <img class="logout" src="logo/logout.png" onclick="window.location.href='php/action/logout.php'" alt="">
    </header>
    <section>
        <!--<img id="filter">-->
        <div id="mountcontent">
            <canvas id="canvas"></canvas>
            <video id="video"></video>
        </div>
        <button id="startbutton">Upload</button>
        <input id="file" type="file" accept="image/*"/>
    </section>
    <div id="capic">
    </div>
    <footer>
        <a class="ftitle">Choix du filtre:</a>
        <?php
        $filter = scandir('filter/');
        $filter = array_diff($filter, array('.', '..'));
        foreach ($filter as $path) {
            $img = base64_encode(file_get_contents('filter/' . $path));
            echo '<img id="imgfilter" src="' . 'filter/' . $path . '">';
        }
        ?>
    </footer>
</div>
<script src="js/takepic.js"></script>
</body>
</html>
