<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require "../connect.php";

if ($_POST && $_POST['img'] && $_SESSION['log']) {
    $img = htmlspecialchars($_POST['img']);
    $img = str_replace('/', '', $img);
    $img = preg_split('/uploads/', $img);
    $query = $DB->prepare("SELECT `userid` FROM `like` WHERE `img_name`=? AND `userid`=?");
    $query->execute(array($img[1], $_SESSION['log']));
    $res = $query->fetchAll();
    if (isset($res[0]['userid']))
        echo 'liked';
    else
        echo 'error';
}