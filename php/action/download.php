<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
require "../../connect.php"; //database conection

$dos = scandir('../../uploads/');
var_dump ($dos);
foreach ($dos as $path) {
    echo base64_encode(file_get_contents('uploads/' . $path) . '\n');
    echo file_get_contents('uploads/' . $path) . '\n';
}