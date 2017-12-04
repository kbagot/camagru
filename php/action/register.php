<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require "../../connect.php"; //database conection

function if_valid($name, $email, $passwd, $DB)
{
    $query = $DB->prepare("SELECT u_name FROM `users` WHERE u_name=?");
    $query->execute(array($name));
    $errorname = $query->fetch();
    $query = $DB->prepare("SELECT email FROM `users` WHERE email=?");
    $query->execute(array($email));
    $errormail = $query->fetch();
    if (!preg_match("/^[A-Za-z0-9_]{1,15}$/", $name) || !filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/^.{6,}$/', $passwd))
        return "Incorrect input";
    if ($errorname && $errormail)
        return ("Nom d'utilisateur et Adresse email deja utiliser");
    else if ($errorname)
        return ("Nom d'utilisateur deja utiliser");
    else if ($errormail)
        return ("Adresse email deja utiliser");
    return 'OK';
}

if ($_POST['u_name'] && $_POST['mail'] && $_POST['submit'] && ($error = if_valid($_POST['u_name'], $_POST['mail'], $_POST['passwd'], $DB)) == 'OK') {
    $query = $DB->prepare("INSERT INTO `users` (`u_name`, `email`, `passwd`, vhash) VALUES (?, ?, ?, ?)");
    $query->execute(array($_POST['u_name'], $_POST['mail'], password_hash($_POST['passwd'], PASSWORD_BCRYPT),
        ($random_hash = md5(uniqid(rand(), true)))));
    /////
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $lol = mail($_POST['mail'], "Camagru Mail validation", '
     <html>
      <body style="background-color: whitesmoke;height: 220px;width: 160px;">
       <h2>Cliquez pour valider votre mail, camagru</h2>
       <a style="background-color: darkcyan; /* Green */border: none;color: white;margin: auto;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;"
class="button" href="http://localhost:9090/hello/camagru/php/action/login.php?hash=' . $random_hash . '">Validation du Compte</a>
      </body>
     </html>
     ', $headers);
    header("Location: ../../main.php");
} else {
    post_flash($error);
    header("Location: ../../index.php");
}
?>
