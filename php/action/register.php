<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require "../../connect.php"; //database conection

function valid_mail($random_hash)
{
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    mail($_POST['mail'], "Camagru Mail validation", '
     <html>
      <body style="background-color: whitesmoke;height: 220px;width: 160px;">
       <h2>Cliquez pour valider votre mail, camagru</h2>
       <a style="background-color: darkcyan; /* Green */border: none;color: white;margin: auto;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;"
class="button" href="http://localhost:8080/hello/camagru/php/action/validate.php?hash=' . $random_hash . '">Validation du Compte</a>
      </body>
     </html>
     ', $headers);
}

if ($_POST['u_name'] && $_POST['mail'] && $_POST['passwd'] && $_POST['submit'] &&
    ($error = if_valid($_POST['u_name'], $_POST['mail'], $_POST['passwd'], $DB)) == 'OK') {
    $query = $DB->prepare("INSERT INTO `users` (`u_name`, `email`, `passwd`, `vhash`, `notif`) VALUES (?, ?, ?, ?, ?)");
    $query->execute(array($_POST['u_name'], $_POST['mail'], password_hash($_POST['passwd'], PASSWORD_BCRYPT),
        ($random_hash = md5(uniqid(rand(), true))), 'checked'));
    valid_mail($random_hash);
    post_flash("Email de validation envoyer");
    header("Location: ../../navpage.php");
} else {
    post_flash($error);
    header("Location: ../../index.php");
}
?>
