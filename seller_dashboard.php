<!-- Display existing properties -->
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
    <!-- Add any additional CSS or JS links here -->
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
      </div>
    </nav>
    <section class="overlay"></section>
</body>
</html>
