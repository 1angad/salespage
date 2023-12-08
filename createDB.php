<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once "connectDB.php";

if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

$users = "CREATE TABLE users (
    UserID int(11) NOT NULL AUTO_INCREMENT,
    FirstName varchar(50) DEFAULT NULL,
    LastName varchar(50) DEFAULT NULL,
    EmailID varchar(100) DEFAULT NULL,
    Username varchar(50) DEFAULT NULL,
    Password varchar(255) DEFAULT NULL,
    AccountType enum('free','premium') DEFAULT NULL,
    PRIMARY KEY (UserID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

$sellerinfo = "CREATE TABLE sellerinfo (
    PropertyID int(11) NOT NULL AUTO_INCREMENT,
    UserID int(11) DEFAULT NULL,
    Location varchar(255) DEFAULT NULL,
    YearBuilt int(11) DEFAULT NULL,
    FloorPlan text DEFAULT NULL,
    Bedrooms int(11) DEFAULT NULL,
    Bathrooms int(11) DEFAULT NULL,
    Garden tinyint(1) DEFAULT NULL,
    Parking tinyint(1) DEFAULT NULL,
    Proximity text DEFAULT NULL,
    PropertyTax decimal(10,2) DEFAULT NULL,
    ImagePath varchar(255) DEFAULT NULL,
    Price int(11) DEFAULT NULL,
    PRIMARY KEY (PropertyID),
    FOREIGN KEY (UserID) REFERENCES users(UserID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

$listedproperties = "CREATE TABLE listedproperties (
    ListingID int(11) NOT NULL AUTO_INCREMENT,
    PropertyID int(11) DEFAULT NULL,
    Description text DEFAULT NULL,
    Location varchar(255) NOT NULL,
    Price decimal(10,2) DEFAULT NULL,
    NumberOfBedrooms int(11) DEFAULT NULL,
    NumberOfBathrooms int(11) DEFAULT NULL,
    SquareFootage decimal(10,2) DEFAULT NULL,
    Garden tinyint(1) DEFAULT NULL,
    Parking tinyint(1) DEFAULT NULL,
    ListingDate date DEFAULT NULL,
    Status enum('available','sold','pending','inactive') DEFAULT 'available',
    PRIMARY KEY (ListingID),
    FOREIGN KEY (PropertyID) REFERENCES sellerinfo(PropertyID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

// SQL to create tables
$buyerinfo = "CREATE TABLE buyerinfo (
    BuyerID int(11) NOT NULL AUTO_INCREMENT,
    UserID int(11) DEFAULT NULL,
    PropertyID int(11) DEFAULT NULL,
    PRIMARY KEY (BuyerID),
    FOREIGN KEY (UserID) REFERENCES users(UserID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

$wishlist = "CREATE TABLE wishlist (
    UserID int(11) NOT NULL,
    PropertyID int(11) NOT NULL,
    PRIMARY KEY (UserID, PropertyID),
    FOREIGN KEY (UserID) REFERENCES users(UserID),
    FOREIGN KEY (PropertyID) REFERENCES sellerinfo(PropertyID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

// Execute queries

if ($link->query($users) === TRUE) {
    echo "Users table created successfully<br>";
} else {
    echo "Error creating users table: " . $link->error . "<br>";
}

if ($link->query($sellerinfo) === TRUE) {
    echo "Sellerinfo table created successfully<br>";
} else {
    echo "Error creating sellerinfo table: " . $link->error . "<br>";
}

if ($link->query($listedproperties) === TRUE) {
    echo "Listedproperties table created successfully<br>";
} else {
    echo "Error creating listedproperties table: " . $link->error . "<br>";
}

if ($link->query($buyerinfo) === TRUE) {
    echo "Buyerinfo table created successfully<br>";
} else {
    echo "Error creating buyerinfo table: " . $link->error . "<br>";
}

if ($link->query($wishlist) === TRUE) {
    echo "Wishlist table created successfully<br>";
} else {
    echo "Error creating wishlist table: " . $link->error . "<br>";
}

$link->close();
?>
