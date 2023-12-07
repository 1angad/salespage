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
      </div> <!-- Closing the sidebar-content div -->
    </div>
  </nav>
  <section class="overlay">
  </section>
</div>
<?php
    // Prepare the SQL statement
    $stmt = $link->prepare("SELECT Location, Age, FloorPlan, Bedrooms, Bathrooms, Garden, Parking, Proximity, PropertyTax FROM SellerInfo WHERE UserID = ?");
    $stmt->bind_param("i", $_SESSION["user"]); // replace with the actual user ID
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if there are any rows
    if ($result->num_rows > 0) {
        // Start the table
        echo "<table>";
        echo "<tr><th>Location</th><th>Age</th><th>FloorPlan</th><th>Bedrooms</th><th>Bathrooms</th><th>Garden</th><th>Parking</th><th>Proximity</th><th>PropertyTax</th></tr>";

        // Fetch each row and display it
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['Location']}</td><td>{$row['Age']}</td><td>{$row['FloorPlan']}</td><td>{$row['Bedrooms']}</td><td>{$row['Bathrooms']}</td><td>{$row['Garden']}</td><td>{$row['Parking']}</td><td>{$row['Proximity']}</td><td>{$row['PropertyTax']}</td></tr>";
        }

        // End the table
        echo "</table>";
    } else {
        // If there are no rows, display a link to add_property.php
        echo "<a href='add_property.php'>Add a property</a>";
    }
?>
</body>
</html>