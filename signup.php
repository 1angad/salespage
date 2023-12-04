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
        <form action="signup.php" method = "post">
            <h1>Sign Up</h1>
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
            
            <input type="submit" name = "submit" value="Register">
            <div class="opposite-link">
                <p>Already have an account? <a href="signin.php">Sign In</a></p>
            </div>
        </form>
    </div>
    <?php
        if(isset($_POST["submit"])) {
            $username = $_POST["user"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $confirmPass = $_POST["confirm-pass"];

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $errors = array();

            if(empty($username) OR empty($email) OR empty($password) OR empty($confirmPass)) {
                array_push($errors, "All fields are required");
            }
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Email is not valid");
            }
            if($password!==$confirmPass) {
                array_push($errors, "Passwords must match");
            }
            require_once "connectDB.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($link, $sql);
            $rowCount = mysqli_num_rows($result);
            if ($rowCount>0) {
                array_push($errors,"Email already in use");
            }
            if (count($errors)>0) {
                foreach ($errors as  $error) {
                    echo "<div class='error'>$error</div>";
                }
            } else {
                $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($link);
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                if($prepareStmt) {
                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $passwordHash);
                    mysqli_stmt_execute($stmt);
                    header("Location: signin.php");
                } else {
                    die("Something went wrong.");
                }
            }
        }
    ?>
</body>
</html>