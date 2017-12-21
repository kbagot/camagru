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

function add_img($file)
{
    global $DB;

    $query = $DB->prepare("INSERT INTO `img` (`userid`, `img_name`) VALUES (?, ?)");
    $query->execute(array($_SESSION['log'], $file));
    return 'OK';
}

if ($_POST && $_POST['img'] && $_POST['filtre']) {
    define('UPLOAD_DIR', '../../uploads/');
    if (!is_dir(UPLOAD_DIR))
        mkdir(UPLOAD_DIR);
    $img = $_POST['img'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $img = base64_decode($img);
    $dest = imagecreatefromstring($img);
    $filter = imagecreatefrompng($_POST['filtre']);
    $newfxsize = 250 - (250 * ((640 - imagesx($dest)) / 640));
    $newfysize = 250 - (250 * ((480 - imagesy($dest)) / 480));
    imagecopyresampled($dest, $filter, imagesx($dest) / 2 - $newfxsize / 2, -10, 0, 0,
        $newfxsize, $newfysize, imagesx($filter), imagesy($filter));
    $file = UPLOAD_DIR . uniqid(). '.png';
    imagepng($dest, $file);
    add_img(str_replace(UPLOAD_DIR, '', $file));
    echo (str_replace(UPLOAD_DIR, 'uploads/', $file));
}
?>
