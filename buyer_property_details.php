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
            <h2>Location: <?php echo $property['Location']; ?></h2>
            <p>Price: $<?php echo number_format($property['Price']); ?></p>
            <p>Year Built: <?php echo $property['YearBuilt']; ?></p>
            <p>Floor Plan: <?php echo $property['FloorPlan']; ?></p>
            <p>Bedrooms: <?php echo $property['Bedrooms']; ?></p>
            <p>Bathrooms: <?php echo $property['Bathrooms']; ?></p>
            <p>Garden: <?php echo $property['Garden'] ? 'Yes' : 'No'; ?></p>
            <p>Parking: <?php echo $property['Parking'] ? 'Yes' : 'No'; ?></p>
            <p>Proximity: <?php echo $property['Proximity']; ?></p>
            <p>Property Tax: <?php echo $property['PropertyTax']; ?></p>
            <form action="add_to_wishlist.php" method="POST">
                <input type="hidden" name="property_id" value="<?php echo $propertyID; ?>">
                <button type="submit" name="add_to_wishlist">Add to Wishlist</button>
            </form>
        <?php else: ?>
            <p>Property not found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
