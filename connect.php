<?php
session_start();
require "config/database.php";
try {
    $DB = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $req = $DB->exec("USE camagru");
} catch (PDOException $e) {
    echo $e->getMessage();
    exit();
}

function post_flash($key)
{
    if ($key)
        $_SESSION['flash'] = $key;
}

function get_flash()
{
    if (isset($_SESSION['flash'])) {
        $msg = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $msg;
    } else
        return false;
}

function valid_hash($hash, $passwd) {
    global $DB;

    $query = $DB->prepare("SELECT vhash FROM `users` WHERE vhash=?");
    $query->execute(array($hash));
    $res = $query->fetch();
    if ($res['vhash'] != $hash) {

        post_flash("Lien de validation invalide");
        return false;
    }
    if ($passwd) {
        $query = $DB->prepare("UPDATE `users` SET vhash = NULL, passwd=? WHERE vhash=?");
        $query->execute(array(password_hash($passwd, PASSWORD_BCRYPT), $hash));
    } else {
        $query = $DB->prepare("SELECT `u_name` FROM `users` WHERE vhash=?");
        $query->execute(array($hash));
        $res = $query->fetch();
        logging($res['u_name']);
        $query = $DB->prepare("UPDATE `users` SET vhash = NULL WHERE vhash=?");
        $query->execute(array($hash));
    }
    return true;
}

function logging($name){
    global $DB;

    $query = $DB->prepare("SELECT uid FROM `users` WHERE u_name=?");
    $query->execute(array($name));
    $res = $query->fetch();
    $_SESSION['log'] = $res['uid'];
}

function if_valid($name, $email, $passwd, $DB) //for registration and update profil
{
    $query = $DB->prepare("SELECT u_name FROM `users` WHERE u_name=?");
    $query->execute(array($name));
    $errorname = $query->fetch();
    $query = $DB->prepare("SELECT email FROM `users` WHERE email=?");
    $query->execute(array($email));
    $errormail = $query->fetch();
    if (($name && !preg_match("/^[A-Za-z0-9_]{1,15}$/", $name)) || ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) ||
        ($passwd && !preg_match("/^(?=.*\d).{4,12}$/", $passwd)))
        return "Incorrect input";
    if ($errorname && $errormail)
        return ("Nom d'utilisateur et Adresse email deja utiliser");
    else if ($errorname)
        return ("Nom d'utilisateur deja utiliser");
    else if ($errormail)
        return ("Adresse email deja utiliser");
    return 'OK';
}
?>