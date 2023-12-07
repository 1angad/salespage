<?php
session_start();
require_once "connectDB.php";

$firstTimeLogin = !isset($_SESSION["visited"]);
$_SESSION["visited"] = true;

$searchTerm = isset($_POST['search']) ? $_POST['search'] : '';

$sql = "SELECT * FROM SellerInfo WHERE CONCAT(Location, Age, FloorPlan, Bedrooms, Bathrooms, Garden, Parking, Proximity, PropertyTax, Price) LIKE ?";
$searchTerm = "%$searchTerm%";
$stmt = mysqli_stmt_init($link);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "SQL Error";
} else {
    mysqli_stmt_bind_param($stmt, "s", $searchTerm);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Buyer Dashboard</title>
    <link rel="stylesheet" href="buyer_dashboard_style.css">
</head>
<body>
    <div class="buyer-container">
        <?php if ($firstTimeLogin): ?>
            <p class="welcome-note">Welcome to our Real Estate Platform! Thank you for choosing us.</p>
        <?php endif; ?>

        <form action="buyer_dashboard.php" method="POST">
            <input type="text" name="search" placeholder="Search properties...">
            <button type="submit">Search</button>
        </form>

        <div class="property-cards">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class='property-card'>
                    <img src='<?php echo $row['ImagePath']; ?>' alt='Property Image'>
                    <p>Location: <?php echo $row['Location']; ?></p>
                    <p>Price: $<?php echo $row['Price']; ?></p>
                    <a href='buyer_property_details.php?property_id=<?php echo $row['PropertyID']; ?>'>View Details</a>
                </div>
                
            <?php endwhile; ?>
            <?php

$wishlistSql = "SELECT * FROM SellerInfo INNER JOIN Wishlist ON SellerInfo.PropertyID = Wishlist.PropertyID WHERE Wishlist.UserID = ?";
$wishlistStmt = mysqli_prepare($link, $wishlistSql);
mysqli_stmt_bind_param($wishlistStmt, "i", $_SESSION["user"]);
mysqli_stmt_execute($wishlistStmt);
$wishlistResult = mysqli_stmt_get_result($wishlistStmt);
?>

<div class="wishlist-properties">
    <h3>Your Wishlist</h3>
    <?php while ($row = mysqli_fetch_assoc($wishlistResult)): ?>
        <div class='property-card'>
        <img src='<?php echo $row['ImagePath']; ?>' alt='Property Image'>
        <p>Location: <?php echo $row['Location']; ?></p>
        <p>Price: $<?php echo $row['Price']; ?></p>
        <a href='buyer_property_details.php?property_id=<?php echo $row['PropertyID']; ?>'>View Details</a>
        </div>
    <?php endwhile; ?>
</div>

        </div>
    </div>
</body>
</html>
