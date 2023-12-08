<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: signin.php");
    exit();
}

$username = $_SESSION["user"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - PROPERTY PARTNERS</title>
    <link rel="stylesheet" href="admin-style.css">
</head>
<body>
    <div class="container">

    <?php
        require_once "connectDB.php";
        $stmt = $link->prepare("SELECT FirstName FROM users WHERE UserID = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $firstName = $user['FirstName'];
    ?>

    <h1>Welcome, <?php echo htmlspecialchars($firstName); ?>!</h1>


<p>Welcome to the CHS Properties admin dashboard. Here, you can manage your property listings, view properties, and more.</p>
        
        <div class="dashboard-actions">
            <a href="seller_dashboard.php" class="action-link">Seller Dashboard</a>
            <a href="buyer_dashboard.php" class="action-link">Buyer Dashboard</a>
            <a href="logout.php" class="action-link">Logout</a>
        </div>
    </div>
</body>
</html>
