<?php
session_start();

// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION["user"])) {
    header("Location: signin.php");
    exit();
}

// Add logic to fetch and display data as needed
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin-style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>

        <!-- User action options -->
        <div class="dashboard-actions">
            <a href="seller_dashboard.php" class="seller_dashboard.php">Upload a Property</a>
            <a href="buyer_dashboard.php" class="buyer_dashboard.php">View Properties</a>
        </div>

        <div class="dashboard-section">
            <h3>Cities with Highest Property Listings</h3>
            <!-- Display data here -->
        </div>

        <div class="dashboard-section">
            <h3>Cities with Highest Properties Sold</h3>
            <!-- Display data here -->
        </div>

        <div class="dashboard-section">
            <h3>User Sales Information</h3>
            <!-- Display data here -->
        </div>

        <div class="opposite-link">
            <a href="logout.php">Logout</a> <!-- Link to a logout script -->
        </div>
    </div>

    <!-- Include any necessary scripts or additional styling for the dashboard -->
</body>
</html>
