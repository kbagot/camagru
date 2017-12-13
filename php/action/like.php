<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require "../../connect.php"; //database conection

function exist($img)
{
    global $DB;

    $query = $DB->prepare("SELECT `uid` FROM `like` WHERE `userid`=? AND `img_name`=?");
    $query->execute(array($_SESSION['log'], $img));
    if (!$query->fetch())
        return false;
    else
        return true;
}

if ($_POST && $_POST['img'] && isset($_SESSION['log'])) {
    $img = $_POST['img'];
    $img = str_replace('/', '', $img);
    $img = preg_split('/uploads/', $img);
    if (!exist($img[1])) {
        $query = $DB->prepare("INSERT INTO `like` (`userid`, `img_name`) VALUES (?, ?)");
        $query->execute(array($_SESSION['log'], $img[1]));
    }
    echo 'ok';
} else if (!isset($_SESSION['log']))
    echo 'nolog';