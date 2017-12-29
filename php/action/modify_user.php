<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require "../../connect.php"; //database conection

if ($_POST && isset($_POST['u_name']) && isset($_POST['mail']) && isset($_POST['submit'])) {
    $uid = $_SESSION['log'];
    if (($error = if_valid($_POST['u_name'], $_POST['mail'], $_POST['passwd'], $DB)) !== 'OK') {
        post_flash($error);
        header("Location: ../../modify_user.php");
        exit();
    }
    if (!$_POST['u_name'] && $_POST['mail'])
        $DB->exec("UPDATE `users` SET `email` = NULL WHERE uid=$uid");
    else if (!$_POST['mail'] && $_POST['u_name'])
        $DB->exec("UPDATE `users` SET `u_name` = NULL WHERE uid=$uid");
    else if ($_POST['mail'] && $_POST['u_name'])
        $DB->exec("UPDATE `users` SET `u_name` = NULL, `email` = NULL WHERE uid=$uid");
    $_POST['u_name'] = htmlspecialchars($_POST['u_name']);
    $_POST['mail'] = htmlspecialchars($_POST['mail']);
    if (!$_POST['notif'])
        $_POST['notif'] = NULL;
    else
        $_POST['notif'] = htmlspecialchars($_POST['notif']);

    $query = $DB->prepare("UPDATE `users` SET `notif`=? WHERE uid=$uid");
    $query->execute(array($_POST['notif']));

    if (!$_POST['u_name'] && $_POST['mail']) {
        $query = $DB->prepare("UPDATE `users` SET `email`=? WHERE uid=$uid");
        $query->execute(array($_POST['mail']));
    } else if (!$_POST['mail'] && $_POST['u_name']) {
        $query = $DB->prepare("UPDATE `users` SET `u_name`=? WHERE uid=$uid");
        $query->execute(array($_POST['u_name']));
    } else if ($_POST['mail'] && $_POST['u_name']){
        $query = $DB->prepare("UPDATE `users` SET `u_name`=?, `email`=? WHERE uid=$uid");
        $query->execute(array($_POST['u_name'], $_POST['mail']));
    }
    if ($_POST['passwd'] && preg_match('/^.{6,}$/', $_POST['passwd'])) {
        $query = $DB->prepare("UPDATE `users` SET `passwd`=? WHERE uid=$uid");
        $query->execute(array(password_hash($_POST['passwd'], PASSWORD_BCRYPT)));
    }
    post_flash("COMPTE MIS A JOUR");
    header("Location: ../../navpage.php");
}
?>