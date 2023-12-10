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
    <title>Property Details</title>
    <link rel="stylesheet" href="property_details.css">
</head>
<body>
    <div class="property-details">
        <?php if ($property): ?>
            <h1>Property Details</h1>
            <img src="<?php echo htmlspecialchars($property['ImagePath']); ?>" alt="Property Image">
            <table>
                <tr>
                    <td><strong>Location:</strong></td>
                    <td><?php echo htmlspecialchars($property['Location']); ?></td>
                </tr>
                <tr>
                    <td><strong>Price:</strong></td>
                    <td>$<?php echo htmlspecialchars(number_format($property['Price'])); ?></td>
                </tr>
                <tr>
                    <td><strong>Year Built:</strong></td>
                    <td><?php echo htmlspecialchars($property['YearBuilt']); ?></td>
                </tr>
                <tr>
                    <td><strong>Square Footage:</strong></td>
                    <td><?php echo htmlspecialchars($property['FloorPlan']); ?></td>
                </tr>
                <tr>
                    <td><strong>Bedrooms:</strong></td>
                    <td><?php echo htmlspecialchars($property['Bedrooms']); ?></td>
                </tr>
                <tr>
                    <td><strong>Bathrooms:</strong></td>
                    <td><?php echo htmlspecialchars($property['Bathrooms']); ?></td>
                </tr>
                <tr>
                    <td><strong>Garden:</strong></td>
                    <td><?php echo $property['Garden'] ? 'Yes' : 'No'; ?></td>
                </tr>
                <tr>
                    <td><strong>Parking:</strong></td>
                    <td><?php echo $property['Parking'] ? 'Yes' : 'No'; ?></td>
                </tr>
                <tr>
                    <td><strong>Proximity to Facilities:</strong></td>
                    <td><?php echo htmlspecialchars($property['Proximity']); ?></td>
                </tr>
                <tr>
                    <td><strong>Property Tax:</strong></td>
                    <td>$<?php echo htmlspecialchars($property['PropertyTax']); ?></td>
                </tr>
            </table>
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
    <button><a href="seller_dashboard.php">Back to Dashboard</a></button>
</body>
</html>
