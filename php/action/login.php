<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require "../../connect.php"; //databhash

function if_valid($name, $passwd)
{
    global $DB;

    $query = $DB->prepare("SELECT passwd FROM `users` WHERE u_name=?");
    $query->execute(array($name));
    $passhash = $query->fetch();
    if (!$passhash)
        return ("Nom d'utilisateur inexistant");
    else if (!password_verify($passwd, $passhash['passwd']))
        return ("Mot de passe incorrect");
    return 'OK';
}

if (valid_hash($_GET['hash'], NULL)) {

}
if ($_POST['u_name'] && $_POST['passwd'] && $_POST['submit'] && ($error = if_valid($_POST['u_name'], $_POST['passwd'])) == 'OK') {
    header("Location: ../../main.php");
} else {
    post_flash($error);
    header("Location: ../../login.php");
}
?>
