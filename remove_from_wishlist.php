<?php
session_start();
require_once "connectDB.php";

if (isset($_GET['property_id'])) {
    $propertyID = $_GET['property_id'];
    $userID = $_SESSION["user"];

    $sql = "DELETE FROM chs_wishlist WHERE UserID = ? AND PropertyID = ?";
    $stmt = mysqli_stmt_init($link);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die("SQL statement preparation failed: " . mysqli_error($link));
    } else {
        mysqli_stmt_bind_param($stmt, "ii", $userID, $propertyID);
        mysqli_stmt_execute($stmt);
    }
}

header("Location: buyer_dashboard.php");
exit();
?>