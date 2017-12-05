<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require "../../connect.php"; //database conection

function if_valid($mail)
{
    global $DB;

    $query = $DB->prepare("SELECT email FROM `users` WHERE email=?");
    $query->execute(array($mail));
    if (!$query->fetch())
        return ("Email inexistant");
    return 'OK';
}

if ($_GET && $_GET['hash'] && $val = valid_hash($_GET['hash'], $_POST['passwd']))
       header("Location: ../../login.php");
else if ($_POST && $_POST['mail'] && $_POST['submit'] && ($error = if_valid($_POST['mail'])) == 'OK') {
    $query = $DB->prepare("UPDATE `users` SET vhash=? WHERE email=?");
    $query->execute(array(($random_hash = md5(uniqid(rand(), true))), $_POST['mail']));
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $lol = mail($_POST['mail'], "Changement de mot de passe, Camagru.", '
     <html>
      <body style="background-color: whitesmoke;height: 220px;width: 160px;">
       <h2>Cliquez pour changer de mot de passe, camagru</h2>
       <a style="background-color: darkcyan; /* Green */border: none;color: white;margin: auto;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;"
class="button" href="http://localhost:8080/hello/camagru/res_passwd.php?hash='.$random_hash.'">Changement de mot de passe</a>
      </body>
     </html>
     ', $headers);
    header("Location: ../../login.php");
} else {
    if ($error)
     post_flash($error);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
