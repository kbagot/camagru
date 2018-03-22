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
u_name VARCHAR(20),
passwd VARCHAR(255),
email VARCHAR(255),
vhash VARCHAR(255),
notif VARCHAR(255))");
$req = $DB->exec("CREATE TABLE IF NOT EXISTS `camagru`.`img`(
uid INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
userid INT,
img_name VARCHAR(255))");
$req = $DB->exec("CREATE TABLE IF NOT EXISTS `camagru`.`like`(
uid INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
userid INT,
img_name VARCHAR(255))");
$req = $DB->exec("CREATE TABLE IF NOT EXISTS `camagru`.`comm`(
uid INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
u_name VARCHAR(255),
img_name VARCHAR(255),
comm VARCHAR(255))");
?>
