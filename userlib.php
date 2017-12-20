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
        $i = 0;
        if (!$_GET || !isset($_GET['page']) || !is_numeric($_GET['page']))
            $i = 0;
        else
            $i = $_GET['page'] * 9;
        $query = $DB->prepare("SELECT `img_name` FROM `img` WHERE `userid`=?");
        $query->execute(array($_SESSION['log']));
        $res = $query->fetchAll();
//        $reverse = scandir('uploads/', SCANDIR_SORT_DESCENDING);
        for ($index = $i; $index < $i + 9; $index++) {
//            $img = base64_encode(file_get_contents('uploads/' . $path));
            if (isset($res[$index]['img_name']))
                echo '<img id="libimg" src="uploads/' . $res[$index]['img_name'] . '">';
        }
        ?>
<div class="pagination">
    <?php
    $count = count($res);
    for ($i = 0; $i < ($count / 9) ; $i++) {
        echo '<a href="userlib.php?page=' . $i . '">' . ($i + 1) . '</a>';
    }
    //   <a href="#">&laquo;</a>
    //   <a href="#">1</a>
    //   <a href="#" class="active">2</a>
    //   <a href="#">3</a>
    //   <a href="#">4</a>
    //   <a href="#">5</a>
    //   <a href="#">6</a>
    //   <a href="#">&raquo;</a>
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
            <img id="delimg" src="logo/delete.png">
            <button id="comm" type="submit">Publier</button>
            <a id="nolog" href="login.php"></a>
        </form>
    </div>
    <button id="close"></button>
</div>
<script src="js/library.js"></script>
</body>
</html>