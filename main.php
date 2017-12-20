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
</head>
<body>
<div class="main">
    <header>
        <button class="nav_b" onclick="window.location.href='php/action/logout.php'">LOGOUT</button>
    </header>
    <section>
        <canvas id="canvas"></canvas>
<!--        <img id="filter">-->
        <video id="video"></video>
        <button id="startbutton">Upload</button>
        <input id="file" type="file" accept="image/*"/>
    </section>
    <div id="capic">
    </div>
    <footer>
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
