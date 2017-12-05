<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require "../../connect.php"; //database conection

$uid = $_SESSION['log'];
$DB->exec("UPDATE `users` SET `u_name` = NULL, `email` = NULL WHERE uid=$uid");

if ($_POST['u_name'] && $_POST['mail'] && $_POST['submit'] &&
    ($error = if_valid($_POST['u_name'], $_POST['mail'], NULL, $DB)) == 'OK') {
    if (!$_POST['notif'])
     $_POST['notif'] = NULL;
    $query = $DB->prepare("UPDATE `users` SET `u_name`=?, `email`=?, `notif`=? WHERE uid=$uid");
    $query->execute(array($_POST['u_name'], $_POST['mail'], $_POST['notif']));
    if ($passwd && !preg_match('/^.{6,}$/', $passwd)) {
        $query = $DB->prepare("UPDATE `users` SET `passwd` VALUES (?)");
        $query->execute(array(password_hash($_POST['passwd'], PASSWORD_BCRYPT)));
    }
    post_flash("COMPTE MIS A JOUR");
    header("Location: ../../navpage.php");
} else {
    post_flash($error);
    echo $error;
    exit();
    header("Location: ../../index.php");
}
?>