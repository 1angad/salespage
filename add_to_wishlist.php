<?php
session_start();
require_once "connectDB.php";

if (!isset($_SESSION["user"]) || !isset($_POST['property_id'])) {
    // Redirect to login page or error page
    header("Location: signin.php");
    exit();
}

$userId = $_SESSION["user"];
$propertyId = $_POST['property_id'];

// Check if the property is already in the wishlist
$sql = "SELECT * FROM chs_wishlist WHERE UserID = ? AND PropertyID = ?";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, "ii", $userId, $propertyId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    // Add to wishlist
    $insertSql = "INSERT INTO chs_wishlist (UserID, PropertyID) VALUES (?, ?)";
    $insertStmt = mysqli_prepare($link, $insertSql);
    mysqli_stmt_bind_param($insertStmt, "ii", $userId, $propertyId);
    mysqli_stmt_execute($insertStmt);
}

header("Location: buyer_dashboard.php");
exit();
?>
