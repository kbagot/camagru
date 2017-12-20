<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require "../../connect.php"; //database conection

if ($_POST && $_POST['u_name'] && $_POST['mail'] && $_POST['submit']) {
    $uid = $_SESSION['log'];
    $DB->exec("UPDATE `users` SET `u_name` = NULL, `email` = NULL WHERE uid=$uid");
    if ($error = if_valid($_POST['u_name'], $_POST['mail'], NULL, $DB) != 'OK') {
        post_flash($error);
        exit();
    }
    if (!$_POST['notif'])
        $_POST['notif'] = NULL;
    $query = $DB->prepare("UPDATE `users` SET `u_name`=?, `email`=?, `notif`=? WHERE uid=$uid");
    $query->execute(array($_POST['u_name'], $_POST['mail'], $_POST['notif']));
    if ($_POST['passwd'] && preg_match('/^.{6,}$/', $_POST['passwd'])) {
        $query = $DB->prepare("UPDATE `users` SET `passwd`=? WHERE uid=$uid");
        $query->execute(array(password_hash($_POST['passwd'], PASSWORD_BCRYPT)));
    }
    post_flash("COMPTE MIS A JOUR");
    header("Location: ../../navpage.php");
}
?>