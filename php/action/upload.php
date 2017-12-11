<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require "../../connect.php"; //database conection

//define('UPLOAD_DIR', '../../uploads/');
//$dest = imagecreatefrompng('../../filter/trump.png');
//$filter = imagecreatefrompng('../../filter/licorn.png');
//imagecopy($dest, $filter,10,10,10,10,150,150);
//$file = UPLOAD_DIR . uniqid(). '.png';
//imagepng($dest, $file);

if ($_POST && $_POST['img'] && $_POST['filtre']) {
    define('UPLOAD_DIR', '../../uploads/');
    if (!is_dir(UPLOAD_DIR))
        mkdir(UPLOAD_DIR);
    $img = $_POST['img'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $img = base64_decode($img);
    $file = UPLOAD_DIR . uniqid(). '.png';
    file_put_contents($file, $img);
    $dest = imagecreatefrompng($file);
    $filter = imagecreatefrompng($_POST['filtre']);
    imagecopy($dest, $filter,50,50,50,50,150,150);
    imagepng($dest,  UPLOAD_DIR. uniqid() . '.png');
}
?>

<!--$data = base64_decode($img);-->
<!--$file = UPLOAD_DIR . uniqid(). '.png';-->
<!--$success = file_put_contents($file, $data);-->
<!--print $success ? $file : 'Unable to save the file.';-->
