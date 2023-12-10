<?php
session_start();
require_once "connectDB.php";

if (!isset($_SESSION["user"])) {
    header("Location: signin.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $propertyID = $_POST['property_id'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    $yearBuilt = $_POST['year_built'];
    $floorPlan = $_POST['floor_plan'];
    $bedrooms = $_POST['bedrooms'];
    $bathrooms = $_POST['bathrooms'];
    $garden = isset($_POST['garden']) ? 1 : 0;
    $parking = isset($_POST['parking']) ? 1 : 0;
    $proximity = $_POST['proximity'];
    $propertyTax = $_POST['property_tax'];
    $propertyLink = $_POST['property_link'];

    $sql = "UPDATE chs_sellerinfo SET Location = ?, Price = ?, YearBuilt = ?, FloorPlan = ?, Bedrooms = ?, Bathrooms = ?, Garden = ?, Parking = ?, Proximity = ?, PropertyTax = ?, ImagePath = ? WHERE PropertyID = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("sdisiiiiissi", $location, $price, $yearBuilt, $floorPlan, $bedrooms, $bathrooms, $garden, $parking, $proximity, $propertyTax, $propertyLink, $propertyID);
    $stmt->execute();

    if ($stmt->execute()) {
            header("Location: property_details.php?property_id=$propertyID");
            exit();
    } else {
        echo "Error updating record: " . $stmt->error;
        echo "SQL error: " . $link->error;
    }

    $stmt->close();
}
?>