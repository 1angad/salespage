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
                                <a href="home.html" class="nav-link">
                                    <i class="bx bx-home-alt icon"></i>
                                    <span class="link">Homepage</span>
                                </a>
                            </li>
                            <li class="list">
                                <a href="seller_dashboard.php" class="nav-link" id = "active">
                                    <i class="bx bx-bar-chart-alt-2 icon"></i>
                                    <span class="link">Seller Dashboard</span>
                                </a>
                            </li>
                            <li class="list">
                                <a href="buyer_dashboard.php" class="nav-link">
                                    <i class="bx bx-bell icon"></i>
                                    <span class="link">Buyer Dashboard</span>
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
    <div class="main-content">
        <div class="property-cards">
            <?php
                $stmt = $link->prepare("SELECT PropertyID, Location, ImagePath, Price FROM chs_sellerinfo WHERE UserID = ?");
                $stmt->bind_param("i", $_SESSION["user"]);
                $stmt->execute();

                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='property-card'>";
                        $imagePath = !empty($row['ImagePath']) ? $row['ImagePath'] : 'house-icon.png';
                        echo "<img src='{$imagePath}' alt='Property Image'>";                    
                        echo "<p>Price: $" . number_format($row['Price']) . "</p>";
                        echo "<p>Location: {$row['Location']}</p>";
                        echo "<a href='property_details.php?property_id={$row['PropertyID']}'>View Details</a>";
                        echo "</div>";
                    }
                } 
            ?>
        </div>
        <div class='add-property-button'>
            <a href='add_property.php'>+ Add New Property</a>
        </div>
    </div>
</body>
</html>
