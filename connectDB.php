<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    $hostName = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "salespage";
    $link = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
    if(!$link){
        die("Something went wrong;");
    }
?>