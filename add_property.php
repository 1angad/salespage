<?php
session_start();
require_once "connectDB.php";

if (!isset($_SESSION["user"])) {
    header("Location: signin.php");
    exit();
}

if (isset($_POST['submit'])) {
    // Retrieve form data
    $price = $_POST['price'];
    $location = $_POST['location'];
    $age = $_POST['yearbuilt'];
    $floorPlan = $_POST['floorPlan'];
    $bedrooms = $_POST['bedrooms'];
    $bathrooms = $_POST['bathrooms'];
    $garden = isset($_POST['garden']) ? 1 : 0;
    $parking = isset($_POST['parking']) ? 1 : 0;
    $proximity = $_POST['proximity'];
    $propertyTax = $_POST['propertyTax'];

    // Handle file upload
    $image = $_FILES['propertyImage'];
    $imageName = $image['name'];
    $imageTmpName = $image['tmp_name'];
    $imageDestination = 'path/to/images/' . $imageName;
    move_uploaded_file($imageTmpName, $imageDestination);

    $userID = $_SESSION["user"];
    $sql = "INSERT INTO SellerInfo (UserID, Price, Location, YearBuilt, FloorPlan, Bedrooms, Bathrooms, Garden, Parking, Proximity, PropertyTax, ImagePath) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($link);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL statement failed";
    } else {
        mysqli_stmt_bind_param($stmt, "isssiiiiidss", $userID, $price, $location, $age, $floorPlan, $bedrooms, $bathrooms, $garden, $parking, $proximity, $propertyTax, $imageDestination);
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
            <input type="number" name="price" placeholder="Price">
            <input type="text" name="location" placeholder="Location">
            <input type="number" name="yearbuilt" placeholder="Year Built">
            <input type="text" name="floorPlan" placeholder="Square Footage">
            <input type="number" name="bedrooms" placeholder="Bedrooms">
            <input type="number" name="bathrooms" placeholder="Bathrooms">
            <input type="checkbox" name="garden"> <label for="garden">Garden</label>
            <input type="checkbox" name="parking"> <label for="parking">Parking</label>
            <input type="text" name="proximity" placeholder="Proximity to Facilities">
            <input type="number" name="propertyTax" placeholder="Property Tax">
            <p>Upload Property Image</p>
            <input type="file" name="propertyImage">
            <input type="submit" name="submit" value="Add Property">
        </form>
    </div>
</body>
</html>

