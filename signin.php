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
        <form action="signin.php" method="post">
            <h1>Sign In</h1>
            <div class="input-box">
                <input type="email" name="email" placeholder="Email Address">
                <img src="bxs-envelope.svg">
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password">
                <img src="bxs-lock-alt.svg">
            </div>
            
            <input type="submit" name="login" value="Log In">
            <div class="opposite-link">
                <p>Don't have an account? <a href="signup.php">Register</a></p>
            </div>
        </form>
    </div>
    <?php
        if (isset($_POST["login"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            require_once "connectDB.php";

            $sql = "SELECT * FROM users WHERE EmailID = ?";
            $stmt = mysqli_stmt_init($link);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo "<div class='error'>SQL Error</div>";
            } else {
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $user = mysqli_fetch_assoc($result);

                if ($user && password_verify($password, $user["Password"])) {
                    session_start();
                    $_SESSION["user"] = $user["UserID"]; 
                    header("Location: dashboard.php");
                    exit();
                } else {
                    echo "<div class='error'>Invalid email or password</div>";
                }
            }
        }
    ?>
</body>
</html>
