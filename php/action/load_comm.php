<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require "../../connect.php";

if ($_POST && $_POST['img']) {
    $img = $_POST['img'];
    $img = str_replace('/', '', $img);
    $img = preg_split('/uploads/', $img);
    $query = $DB->prepare("SELECT `u_name`, `comm` FROM `comm` WHERE `img_name`=?");
    $query->execute(array($img[1]));
    $res = $query->fetchAll();
    if (isset($res[0]['comm']))
        echo json_encode($res);
    else
      echo 'nocomm';
}
