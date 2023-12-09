<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salespage</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <form action="signup.php" method="post">
        <h1>Sign Up</h1>

        <div class="input-box">
            <input type="text" name="first-name" placeholder="First Name">
            <img src="bxs-user.svg"> <!-- Update or remove the icon as needed -->
        </div>

        <div class="input-box">
            <input type="text" name="last-name" placeholder="Last Name">
            <img src="bxs-user.svg"> <!-- Update or remove the icon as needed -->
        </div>

        <div class="input-box">
            <input type="text" name="user" placeholder="Username">
            <img src="bxs-user.svg">
        </div>

        <div class="input-box">
            <input type="email" name="email" placeholder="Email Address">
            <img src="bxs-envelope.svg">
        </div>

        <div class="input-box">
            <input type="password" name="password" placeholder="Password">
            <img src="bxs-lock-alt.svg">
        </div>

        <div class="input-box">
            <input type="password" name="confirm-pass" placeholder="Confirm Password">
        </div>

        <input type="submit" name="submit" value="Register">

        <div class="opposite-link">
            <p>Already have an account? <a href="signin.php">Sign In</a></p>
        </div>
    </form>
</div>

<?php
if(isset($_POST["submit"])) {
    require_once "connectDB.php";

    $firstName = $_POST["first-name"];
    $lastName = $_POST["last-name"];
    $username = $_POST["user"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPass = $_POST["confirm-pass"];
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $errors = array();

    // Validate inputs
    if(empty($username) || empty($email) || empty($password) || empty($confirmPass) || empty($firstName) || empty($lastName)) {
        array_push($errors, "All fields are required");
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid");
    }
    if($password !== $confirmPass) {
        array_push($errors, "Passwords must match");
    }

    // Check if email already exists
    $sql = "SELECT EmailID FROM users WHERE EmailID = ?";
    $stmt = mysqli_stmt_init($link);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die("SQL statement preparation failed: " . mysqli_error($link));
    } else {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            array_push($errors, "Email already registered");
        }
        mysqli_stmt_close($stmt);
    }
    if (count($errors) == 0) {
        $sql = "INSERT INTO users (FirstName, LastName, EmailID, Username, Password) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($link);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            die("SQL statement preparation failed: " . mysqli_error($link));
        } else {
            mysqli_stmt_bind_param($stmt, "sssss", $firstName, $lastName, $email, $username, $passwordHash);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            header("Location: signin.php");
            exit();
        }
    }

    foreach ($errors as $error) {
        echo "<div class='error'>$error</div>";
    }
}
?>

</body>
</html>