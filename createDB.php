<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    require_once "connectDB.php";
    if(!$link){
        die("Something went wrong;");
    }
    
    $users = "CREATE TABLE users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(128) NOT NULL,
        email VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL
    )";

    if($link->query($users) === TRUE) {
        echo "USERS table created.";
    } else {
        echo "Error creating table: " . $link->error;
    }
?>