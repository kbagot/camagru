<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require "../../connect.php"; //database conection

if ($_POST && $_POST['img']) {
    define('UPLOAD_DIR', '../../uploads/');
    if (!is_dir(UPLOAD_DIR))
        mkdir(UPLOAD_DIR);
    $img = $_POST['img'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $file = UPLOAD_DIR . uniqid(). '.png';
    $success = file_put_contents($file, $data);
    print $success ? $file : 'Unable to save the file.';
//    file_put_contents('img.png', base64_decode($base64string));
}
?>