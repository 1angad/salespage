<?php
session_start();
require_once "connectDB.php";

// Assuming you have the user's ID stored in session
if (!isset($_SESSION["user"])) {
    header("Location: signin.php");
    exit();
}
// Fetch all properties from the ListedProperties table
$sql = "SELECT * FROM ListedProperties";
$stmt = mysqli_stmt_init($link);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "SQL statement failed";
} else {
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer Dashboard</title>
    <!-- Add any additional CSS or JS links here -->
</head>
<body>
    <div class="container">
        <h1>Property Listings</h1>
        <div class="property-listings">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='property-card'>";
                echo "<h2>" . $row['Description'] . "</h2>";
                echo "<p>Location: " . $row['Location'] . "</p>";
                echo "<p>Price: $" . $row['Price'] . "</p>";
                echo "<p>Bedrooms: " . $row['NumberOfBedrooms'] . "</p>";
                echo "<p>Bathrooms: " . $row['NumberOfBathrooms'] . "</p>";
                echo "<p>Square Footage: " . $row['SquareFootage'] . " sqft</p>";
                echo "<p>Garden: " . ($row['Garden'] ? 'Yes' : 'No') . "</p>";
                echo "<p>Parking: " . ($row['Parking'] ? 'Yes' : 'No') . "</p>";
                echo "<p>Listed on: " . $row['ListingDate'] . "</p>";
                echo "<p>Status: " . $row['Status'] . "</p>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
</body>
</html>
