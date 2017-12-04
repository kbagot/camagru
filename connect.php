<?php
session_start();
require "php/config/database.php";
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
    $res = $query->fetch()['vhash'];
    if ($res != $hash) {
        post_flash("Lien de validation invalide");
        return false;
    }
    if ($passwd) {
        $query = $DB->prepare("UPDATE `users` SET vhash = NULL, passwd=? WHERE vhash=?");
        $query->execute(array(password_hash($passwd, PASSWORD_BCRYPT), $hash));
    } else {
        $query = $DB->prepare("UPDATE `users` SET vhash = NULL WHERE vhash=?");
        $query->execute(array($hash));
    }
    return true;
}
?>