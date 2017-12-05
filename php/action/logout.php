<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require "../../connect.php"; //databhash/

$_SESSION = array();
header("Location: ../../index.php");
