<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require "../connect.php"; //databhash

if (isset($_GET['hash']) && valid_hash($_GET['hash'], NULL)) {
    post_flash("COMPTE VALIDER");
    header("Location: ../navpage.php");
    exit();
}
