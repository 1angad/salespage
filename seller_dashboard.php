<?php
// Start the session and include database connection
session_start();
require_once "connectDB.php";

if (!isset($_SESSION["user"])) {
    header("Location: signin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard</title>
    <link rel="stylesheet" href="seller_dashboard_style.css">
</head>
<body>
    <div class="seller-container">
        <nav>
            <div class="sidebar">
                <div class="logo">
                    <i class="bx bx-menu menu-icon"></i>
                    <span class="logo-name">Menu</span>
                </div>
                <div class="sidebar-content">
                    <nav>
                        <ul class="lists">
                            <li class="list">
                                <a href="seller_dashboard.php" class="nav-link">
                                    <i class="bx bx-home-alt icon"></i>
                                    <span class="link">Seller Dashboard</span>
                                </a>
                            </li>
                            <li class="list">
                                <a href="buyer_dashboard.php" class="nav-link">
                                    <i class="bx bx-bar-chart-alt-2 icon"></i>
                                    <span class="link">Buyer Dashboard</span>
                                </a>
                            </li>
                            <li class="list">
                                <a href="admin_dashboard.php" class="nav-link">
                                    <i class="bx bx-bell icon"></i>
                                    <span class="link">Admin Dashboard</span>
                                </a>
                            </li>
                            <li class="list">
                                <a href="logout.php" class="nav-link">
                                    <i class="bx bx-log-out icon"></i>
                                    <span class="link">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </nav>
        <section class="overlay">
        </section>
    </div>
    <div class="main-content">
        <div class="property-cards">
            <?php

                $stmt = $link->prepare("SELECT PropertyID, Location, ImagePath FROM SellerInfo WHERE UserID = ?");
                $stmt->bind_param("i", $_SESSION["user"]);
                $stmt->execute();

                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='property-card'>";
                        echo "<img src='{$row['ImagePath']}' alt='Property Image'>";
                        echo "<p>Property ID: {$row['PropertyID']}</p>";
                        echo "<p>Location: {$row['Location']}</p>";
                        echo "<a href='property_details.php?property_id={$row['PropertyID']}'>View Details</a>";
                        echo "</div>";
                    }
                } 
            ?>
            <div class='add-property-button'>
                <a href='add_property.php'>Add New Property</a>
            </div>
        </div>
    </div>
</body>
</html>
