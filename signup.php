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

        <div class="account-type">
            <label><input type="radio" name="account-type" value="free" checked> Free Account</label>
            <label><input type="radio" name="account-type" value="premium"> Premium Account</label>
        </div>

        <input type="submit" name="submit" value="Register">

        <div class="opposite-link">
            <p>Already have an account? <a href="signin.php">Sign In</a></p>
        </div>
    </form>
</div>

    <?php
    if(isset($_POST["submit"])) {
        $firstName = $_POST["first-name"];
        $lastName = $_POST["last-name"];
        $username = $_POST["user"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmPass = $_POST["confirm-pass"];
        $accountType = $_POST["account-type"];
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $errors = array();

        if(empty($username) || empty($email) || empty($password) || empty($confirmPass) || empty($firstName) || empty($lastName)) {
            array_push($errors, "All fields are required");
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email is not valid");
        }
        if($password !== $confirmPass) {
            array_push($errors, "Passwords must match");
        }
        require_once "connectDB.php";
        $sql = "INSERT INTO users (FirstName, LastName, EmailID, Username, Password, AccountType) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($link);
        
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            die("SQL statement preparation failed: " . mysqli_error($link));
        } else {
            // Bind parameters to the prepared statement
            mysqli_stmt_bind_param($stmt, "ssssss", $firstName, $lastName, $email, $username, $passwordHash, $accountType);
        
            // Execute the prepared statement
            mysqli_stmt_execute($stmt);
        
            // Redirect to the sign-in page upon successful registration
            header("Location: signin.php");
        }
        if (count($errors) > 0) {
            foreach ($errors as $error) {
                echo "<div class='error'>$error</div>";
            }
        } else {
            $sql = "INSERT INTO users (FirstName, LastName, EmailID, Username, Password, AccountType) VALUES (?, ?, ?, ?, ?, ?)";
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                die("SQL statement failed");
            } else {
                mysqli_stmt_bind_param($stmt, "ssssss", $firstName, $lastName, $email, $username, $passwordHash, $accountType);
                mysqli_stmt_execute($stmt);
                header("Location: signin.php");
            }
        }
    }
?>
</body>
</html>