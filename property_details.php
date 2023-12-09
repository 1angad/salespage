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
    header("Location: seller_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Property Details</title>
    <link rel="stylesheet" href="property_details.css">
</head>
<body>
    <div class="property-details">
        <?php if ($property): ?>
            <h1>Property Details</h1>
            <img src="<?php echo htmlspecialchars($property['ImagePath']); ?>" alt="Property Image">
            <p><strong>Location:</strong> <?php echo htmlspecialchars($property['Location']); ?></p>
            <p><strong>Price:</strong> $<?php echo htmlspecialchars(number_format($property['Price'])); ?></p>
            <p><strong>Year Built:</strong> <?php echo htmlspecialchars($property['YearBuilt']); ?></p>
            <p><strong>Square Footage:</strong> <?php echo htmlspecialchars($property['FloorPlan']); ?></p>
            <p><strong>Bedrooms:</strong> <?php echo htmlspecialchars($property['Bedrooms']); ?></p>
            <p><strong>Bathrooms:</strong> <?php echo htmlspecialchars($property['Bathrooms']); ?></p>
            <p><strong>Garden:</strong> <?php echo $property['Garden'] ? 'Yes' : 'No'; ?></p>
            <p><strong>Parking:</strong> <?php echo $property['Parking'] ? 'Yes' : 'No'; ?></p>
            <p><strong>Proximity to Facilities:</strong> <?php echo htmlspecialchars($property['Proximity']); ?></p>
            <p><strong>Property Tax:</strong> $<?php echo htmlspecialchars($property['PropertyTax']); ?></p>

            <div class="propertyButtons">
                <form action="edit_property.php" id = "edit" method="GET">
                    <input type="hidden" name="property_id" value="<?php echo $propertyID; ?>">
                    <button type="submit" name="edit">Edit Property</button>
                </form>

                <form action="delete_property.php" id = "delete" method="POST">
                    <input type="hidden" name="property_id" value="<?php echo $propertyID; ?>">
                    <button type="submit" name="delete">Delete Property</button>
                </form>
            </div>
            
        <?php else: ?>
            <p>Property not found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
