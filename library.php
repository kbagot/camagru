<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<div class="main">
    <header>
        <?php require('connect.php');
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        if ($_SESSION['log']) { ?>
            <button class="nav_b" onclick="window.location.href='php/action/logout.php'">LOGOUT</button>
        <?php } ?>
    </header>
    <section>
    </section>
    <section>
        <?php
        $i = 0;
        if (!$_GET)
            $i = 0;
        else if ($_GET['page'])
            $i = $_GET['page'] * 9;
        $reverse = scandir('uploads/', SCANDIR_SORT_DESCENDING);
        for ($index = $i; $index < $i + 9; $index++) {
//            $img = base64_encode(file_get_contents('uploads/' . $path));
            if (isset($reverse[$index + 2]))
                echo '<img id="libimg" src="uploads/' . $reverse[$index] . '">';
        }
        ?>
        <div class="pagination">
            <?php
            $count = count($reverse) - 2;
            for ($i = 0; $i < ($count / 9); $i++) {
                echo '<a href="library.php?page=' . $i . '">' . ($i + 1) . '</a>';
            }
            //           <a href="#">&laquo;</a>
            //           <a href="#">1</a>
            //           <a href="#" class="active">2</a>
            //           <a href="#">3</a>
            //           <a href="#">4</a>
            //           <a href="#">5</a>
            //           <a href="#">6</a>
            //           <a href="#">&raquo;</a>
            ?>
        </div>
    </section>
    <div>
    </div>
    <footer>
    </footer>
</div>
<div id="displayimg">
    <div id="content">
        <img id="showimg">
        <div id="showcomm">
        </div>
        <form action="" onsubmit="sendCom(event)">
            <textarea autofocus name="comm" id="combox" maxlength="255">Commentaire ...</textarea>
            <img id="like" src="logo/like.png">
            <button id="comm" type="submit">Publier</button>
            <a id="nolog" href="login.php"></a>
        </form>
    </div>
    <button id="close"></button>
</div>
<script src="js/library.js"></script>
</body>
</html>
