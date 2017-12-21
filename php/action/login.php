<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require "../../connect.php"; //databhash

function if_valid_log($name, $passwd)
{
    global $DB;

    $query = $DB->prepare("SELECT passwd FROM `users` WHERE u_name=?");
    $query->execute(array($name));
    $passhash = $query->fetch();
    $query = $DB->prepare("SELECT vhash FROM `users` WHERE u_name=?");
    $query->execute(array($name));
    $vhash = $query->fetch();
//    var_dump($vhash);
//    exit();
    if (!$passhash)
        return ("Nom d'utilisateur inexistant");
    else if (!password_verify($passwd, $passhash['passwd']))
        return ("Mot de passe incorrect");
    else if ($vhash['vhash'])
        return ("Compte non valide");
    return 'OK';
}

if (isset($_POST['u_name']) && isset($_POST['passwd']) && isset($_POST['submit']) &&
    ($error = if_valid_log(htmlspecialchars($_POST['u_name']), htmlspecialchars($_POST['passwd']))) == 'OK') {
    logging(htmlspecialchars($_POST['u_name']));
    post_flash("Connecter avec succes");
    header("Location: ../../navpage.php");
} else {
    post_flash($error);
    header("Location: ../../login.php");
}
?>
