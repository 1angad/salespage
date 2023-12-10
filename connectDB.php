<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$hostName = "localhost"; 
$dbUser = "gsingh14";
$dbPassword = "gsingh14";
$dbName = "gsingh14";

$link = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
