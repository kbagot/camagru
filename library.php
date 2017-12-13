<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<div class="main">
    <header>
    </header>
    <section>
    </section>
    <section>
        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        require "connect.php"; //database conection

        $dos = scandir('uploads/');
        $reverse = array_reverse($dos, true);
        foreach ($reverse as $path) {
//            $img = base64_encode(file_get_contents('uploads/' . $path));
            echo '<img id="libimg" src="uploads/' . $path . '">';
        }
        ?>
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
            <img id="like" src="http://www.opensticker.com/4636/sticker-symbole-like.jpg">
            <button id="comm" type="submit">Publier</button>
            <a id="nolog" href="login.php"></a>
        </form>
    </div>
    <button id="close"></button>
</div>
<script src="js/library.js"></script>
</body>
</html>
