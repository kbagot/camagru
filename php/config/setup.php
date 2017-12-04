<?php
require "database.php";
try {
    $DB = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
    exit();
}
$req = $DB->exec("CREATE DATABASE IF NOT EXISTS `camagru`");
$req = $DB->exec("CREATE TABLE IF NOT EXISTS `camagru`.`users`(
uid INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
u_name VARCHAR(15),
passwd VARCHAR(255),
email VARCHAR(255),
valid BOOLEAN NULL DEFAULT FALSE,
vhash VARCHAR(255))");
?>
