<?php
session_start();
$_SESSION = array();
session_destroy();
// Redirect to login page
header("Location: signin.php");
exit();
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
            <p><a href="#">Logout</a></p>
        </div>
    </div>

    <!-- Include any necessary scripts or additional styling for the dashboard -->
</body>
</html>
