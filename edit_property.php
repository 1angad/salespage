<?php
session_start();
require_once "connectDB.php";

if (!isset($_SESSION["user"])) {
    header("Location: signin.php");
    exit();
}

if (isset($_GET['property_id'])) {
    $propertyID = $_GET['property_id'];

    $sql = "SELECT * FROM chs_sellerinfo WHERE PropertyID = ?";
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
    <title>Edit Property</title>
    <link rel="stylesheet" href="property_details.css">
</head>
<body>
    <div class="edit-property">
        <?php if ($property): ?>
            <h1>Edit Property</h1>
            <form action="update_property.php" method="POST">
                <input type="hidden" name="property_id" value="<?php echo $propertyID; ?>">

                <label for="location">Location:</label>
                <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($property['Location']); ?>">

                <label for="price">Price:</label>
                <input type="text" id="price" name="price" value="<?php echo htmlspecialchars($property['Price']); ?>">

                <label for="year_built">Year Built:</label>
                <input type="text" id="year_built" name="year_built" value="<?php echo htmlspecialchars($property['YearBuilt']); ?>">

                <label for="floor_plan">Square Footage:</label>
                <input type="text" id="floor_plan" name="floor_plan" value="<?php echo htmlspecialchars($property['FloorPlan']); ?>">

                <label for="bedrooms">Bedrooms:</label>
                <input type="text" id="bedrooms" name="bedrooms" value="<?php echo htmlspecialchars($property['Bedrooms']); ?>">

                <label for="bathrooms">Bathrooms:</label>
                <input type="text" id="bathrooms" name="bathrooms" value="<?php echo htmlspecialchars($property['Bathrooms']); ?>">

                <label for="garden">Garden:</label>
                <input type="checkbox" id="garden" name="garden" <?php echo $property['Garden'] ? 'checked' : ''; ?>>

                <label for="parking">Parking:</label>
                <input type="checkbox" id="parking" name="parking" <?php echo $property['Parking'] ? 'checked' : ''; ?>>

                <label for="proximity">Proximity to Facilities:</label>
                <input type="text" id="proximity" name="proximity" value="<?php echo htmlspecialchars($property['Proximity']); ?>">

                <label for="property_tax">Property Tax:</label>
                <input type="text" id="property_tax" name="property_tax" value="<?php echo htmlspecialchars($property['PropertyTax']); ?>">

                <label for="property_link">Property Image Link:</label>
                <input type="text" id="property_link" name="property_link" value="<?php echo htmlspecialchars($property['ImagePath']); ?>">
                
                <button type="submit" name="update">Update Property</button>
            </form>
        <?php else: ?>
            <p>Property not found.</p>
        <?php endif; ?>
    </div>
</body>
</html>