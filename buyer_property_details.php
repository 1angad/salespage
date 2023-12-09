<?php
session_start();
require_once "connectDB.php";

if (!isset($_SESSION["user"])) {
    header("Location: signin.php");
    exit();
}

if (isset($_GET['property_id'])) {
    $propertyID = $_GET['property_id'];

    $sql = "SELECT * FROM SellerInfo WHERE PropertyID = ?";
    $stmt = mysqli_stmt_init($link);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL Error";
    } else {
        mysqli_stmt_bind_param($stmt, "i", $propertyID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $property = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
    }
} else {
    header("Location: buyer_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Property Details</title>
    <link rel="stylesheet" href="buyer_property_details_style.css">
</head>
<body>
    <div class="property-details">
        <?php if ($property): ?>
            <img src="<?php echo $property['ImagePath']; ?>" alt="Property Image">
            <div class="home-container">
                <div class="main-info">
                    <div class="pricing-address">
                        <h2>Price: $<?php echo number_format($property['Price']); ?></h2>
                        <p>Location: <?php echo $property['Location']; ?><p>
                    </div>
                    <div class="bbsqft">
                        <div class="bbsqft-info">
                            <h2><?php echo $property['Bedrooms']; ?></h2>
                            <p>beds</p>
                        </div>
                        <div class="bbsqft-info">
                            <h2><?php echo $property['Bathrooms']; ?></h2>
                            <p>baths</p>
                        </div>
                        <div class="bbsqft-info">
                            <h2><?php echo $property['FloorPlan']; ?></h2>
                            <p>sqft</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="other-info">
                <p>Year Built: <?php echo $property['YearBuilt']; ?></p>
                <p>Garden: <?php echo $property['Garden'] ? 'Yes' : 'No'; ?></p>
                <p>Parking: <?php echo $property['Parking'] ? 'Yes' : 'No'; ?></p>
                <p>Proximity: <?php echo $property['Proximity']; ?></p>
                <p>Property Tax: <?php echo $property['PropertyTax']; ?></p>
            </div>
        <?php else: ?>
            <p>Property not found.</p>
        <?php endif; ?>
    </div>
    <div class="wishlist">
        <form action="add_to_wishlist.php" method="POST">
            <input type="hidden" name="property_id" value="<?php echo $propertyID; ?>">
            <button type="submit" name="add_to_wishlist">Add to Wishlist</button>
        </form>
        <button><a href="buyer_dashboard.php" id = "add_to_wishlist">Back to Dashboard</a></button>
    </div>
</body>
</html>
