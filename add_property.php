<?php
session_start();
require_once "connectDB.php";

if (!isset($_SESSION["user"])) {
    header("Location: signin.php");
    exit();
}

if (isset($_POST['submit'])) {
    $price = $_POST['price'];
    $location = $_POST['location'];
    $age = $_POST['yearbuilt'];
    $floorPlan = $_POST['floorPlan'];
    $bedrooms = $_POST['bedrooms'];
    $bathrooms = $_POST['bathrooms'];
    $garden = isset($_POST['garden']) ? 1 : 0;
    $parking = isset($_POST['parking']) ? 1 : 0;
    $proximity = $_POST['proximity'];
    $propertyTax = $price * 0.07;

    $propertyLink = $_POST['propertyLink'];

    $userID = $_SESSION["user"];
    $sql = "INSERT INTO chs_sellerinfo (UserID, Price, Location, YearBuilt, FloorPlan, Bedrooms, Bathrooms, Garden, Parking, Proximity, PropertyTax, ImagePath) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($link);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL statement failed";
    } else {
        mysqli_stmt_bind_param($stmt, "isssiiiiidss", $userID, $price, $location, $age, $floorPlan, $bedrooms, $bathrooms, $garden, $parking, $proximity, $propertyTax, $propertyLink);
        mysqli_stmt_execute($stmt);
        header("Location: seller_dashboard.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Property</title>
    <link rel="stylesheet" href="admin-style.css">
</head>
<body>
    <div class="container">
        <h1>Create Property Listing</h1>
        <form action="add_property.php" method="post" enctype="multipart/form-data">
            <input type="number" name="price" placeholder="Price" required>
            <input type="text" name="location" placeholder="Location" required>
            <input type="number" name="yearbuilt" placeholder="Year Built" required>
            <input type="text" name="floorPlan" placeholder="Square Footage" required>
            <input type="number" name="bedrooms" placeholder="Bedrooms" required>
            <input type="number" name="bathrooms" placeholder="Bathrooms" required>
            <div class="checkboxes">
                <div>
                    <label for="garden">Garden</label><input type="checkbox" name="garden">
                </div>
                <div>
                    <label for="parking">Parking</label><input type="checkbox" name="parking">
                </div>
            </div>
            <input type="text" name="proximity" placeholder="Proximity to Facilities">
            <p>Link Property Image</p>
            <input type="text" name="propertyLink">
            <input type="submit" name="submit" value="Add Property">
        </form>
    </div>
    <a href="seller_dashboard.php">Back</a>
</body>
</html>

