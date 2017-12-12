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
        //        var_dump ($dos);
        foreach ($reverse as $path) {
            $img = base64_encode(file_get_contents('uploads/' . $path));
            echo '<img id="libimg" src="data:image/png;base64,' . $img . '">';
        }
        ?>
    </section>
    <div>
    </div>
    <footer>
    </footer>
</div>
<div id="displayimg">
    <div>
        <img id="showimg">
    </div>
    <button id="close"></button>
</div>
<script src="js/library.js"></script>
</body>
</html>
