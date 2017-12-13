<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require "../../connect.php"; //database conectiondatabase conection

//function exist($img)
//{
//    global $DB;
//
//    $query = $DB->prepare("SELECT `uid` FROM `like` WHERE `userid`=? AND `img_name`=?");
//    $query->execute(array($_SESSION['log'], $img));
//    if (!$query->fetch())
//        return false;
//    else
//        return true;
//}
function comm_mail($img)
{
    global $DB;

    $query = $DB->prepare("SELECT `userid` FROM `img` WHERE `img_name`=?");
    $query->execute(array($img));
    $uid = $query->fetch();
    $query = $DB->prepare("SELECT `email` FROM `users` WHERE `uid`=?");
    $query->execute(array($uid['userid']));
    $email = $query->fetch()['email'];
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    mail($email, "Camagru Nouveau commentaire", '
     <html>
      <body style="background-color: whitesmoke;height: 220px;width: 160px;">
       <h2>Vous avez recu un nouveau Commentaire</h2>
       <a style="background-color: darkcyan; /* Green */border: none;color: white;margin: auto;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;"
class="button" href="http://localhost:8080/hello/camagru/library.php">Votre Bibliotheque</a>
      </body>
     </html>
     ', $headers);
}

function get_name($name)
{
    global $DB;

    $query = $DB->prepare("SELECT `u_name` FROM `users` WHERE `uid`=?");
    $query->execute(array($_SESSION['log']));
    return ($query->fetch()['u_name']);
}

if ($_POST && $_POST['img'] && $_POST['comm'] && isset($_SESSION['log'])) {
    $img = $_POST['img'];
    $img = str_replace('/', '', $img);
    $img = preg_split('/uploads/', $img);
//    if (!exist($img[1])) {
    $query = $DB->prepare("INSERT INTO `comm` (`u_name`, `img_name`, `comm`) VALUES (?, ?, ?)");
    $query->execute(array(get_name($_SESSION['log']), $img[1], $_POST['comm']));
    comm_mail($img[1]);
    echo 'ok';
} else if (!isset($_SESSION['log']))
    echo 'nolog';