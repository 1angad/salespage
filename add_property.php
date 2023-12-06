<?php
// Start the session and include database connection
session_start();
require_once "connectDB.php";

if (!isset($_SESSION["user"])) {
    header("Location: signin.php");
    exit();
}
// Process form submission for adding new property
if (isset($_POST['submit'])) {
    // Retrieve form data
    $location = $_POST['location'];
    $age = $_POST['age'];
    $floorPlan = $_POST['floorPlan'];
    $bedrooms = $_POST['bedrooms'];
    $bathrooms = $_POST['bathrooms'];
    $garden = isset($_POST['garden']) ? 1 : 0; // Assuming checkbox for garden
    $parking = isset($_POST['parking']) ? 1 : 0; // Assuming checkbox for parking
    $proximity = $_POST['proximity'];
    $propertyTax = $_POST['propertyTax']; // Calculate this based on your logic

    // Handle file upload
    $image = $_FILES['propertyImage'];
    $imageName = $image['name'];
    $imageTmpName = $image['tmp_name'];
    $imageDestination = 'C:\xampp\htdocs\project4\salespage' . $imageName;
    move_uploaded_file($imageTmpName, $imageDestination);

    // Insert into database
    $sql = "INSERT INTO SellerInfo (UserID, Location, Age, FloorPlan, Bedrooms, Bathrooms, Garden, Parking, Proximity, PropertyTax, ImagePath) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($link);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL statement failed";
    } else {
        mysqli_stmt_bind_param($stmt, "isisiiiiids", $userID, $location, $age, $floorPlan, $bedrooms, $bathrooms, $garden, $parking, $proximity, $propertyTax, $imageDestination);
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
    <!-- Add any additional CSS or JS links here -->
    <link rel="stylesheet" href="admin-style.css">
</head>
<body>
    <div class="container">
        <h1> Create Property Listing </h1> <br>
        <!-- Form for adding new property -->
        <form action="seller_dashboard.php" method="post" enctype="multipart/form-data">
            <input type="text" name="location" placeholder="Location">
            <input type="number" name="age" placeholder="Age">
            <input type="text" name="floorPlan" placeholder="Floor Plan">
            <input type="number" name="bedrooms" placeholder="Bedrooms">
            <input type="number" name="bathrooms" placeholder="Bathrooms">
            <p>Garden</p> 
            <input type="checkbox" name="garden" placeholder="Garden">
            <p>Parking</p> 
            <input type="checkbox" name="parking" placeholder="Parking"> <br>
            <input type="text" name="proximity" placeholder="Proximity to Facilities">
            <input type="number" name="propertyTax" placeholder="Property Tax">
            <p>Upload Property Image</p>
            <input type="file" name="propertyImage">
            <input type="submit" name="submit" value="Add Property">
        </form>
        <?php
        $sql = "SELECT * FROM SellerInfo WHERE UserID = ?";
        $stmt = mysqli_stmt_init($link);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "SQL statement failed";
        } else {
            mysqli_stmt_bind_param($stmt, "i", $userID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='property-card'>";
                echo "<img src='path/to/images/" . $row['ImagePath'] . "' alt='Property Image'>";
                // Display other property details
                echo "</div>";
            }
        }
        ?>
    </div>
</body>
</html>
