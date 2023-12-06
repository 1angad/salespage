<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$hostName = "localhost"; // Specify the port if MySQL is running on a non-default port
$dbUser = "root";
$dbPassword = "";
$dbName = "propertydb";

// Establishing the database connection
$link = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

// Check the connection
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
