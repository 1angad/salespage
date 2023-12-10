<?php
// Start the session and include database connection
session_start();
require_once "connectDB.php";

if (!isset($_SESSION["user"])) {
    header("Location: signin.php");
    exit();
}

// Check if deletion is requested
if (isset($_POST['delete']) && isset($_POST['property_id'])) {
    $propertyID = $_POST['property_id'];

    // Delete the property from the database
    $sql = "DELETE FROM chs_sellerinfo WHERE PropertyID = ?";
    $stmt = mysqli_stmt_init($link);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL Error";
    } else {
        mysqli_stmt_bind_param($stmt, "i", $propertyID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    // Redirect back to the seller dashboard
    header("Location: seller_dashboard.php");
    exit();
}
?>
