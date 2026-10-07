<?php
session_start();
include "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $hashed_password = sha1($password);

    $sql = "SELECT * FROM users
            WHERE email='$email'
            AND password='$hashed_password'";

    $result = $conn->query($sql);

    if ($result->num_rows == 1) {

        $user = $result->fetch_assoc();

        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_name"] = $user["name"];

        header("Location: dashboard.php");
        exit();

    } else {

        $message = "Invalid email or password.";

    }
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Login - ResumeHub</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <nav>

        <div class="logo">ResumeHub</div>

        <div class="nav-links">

            <a href="index.php">Home</a>

            <a href="register.php">Register</a>

        </div>

    </nav>


    <div class="form-container">

        <h2>Login to ResumeHub</h2>

        <?php

        if ($message != "") {

            echo "<p style='color:red;'>$message</p>";

        }

        ?>

        <form method="POST">

            <label>Email</label>

            <input
                type="email"
                name="email"
                required
            >


            <label>Password</label>

            <input
                type="password"
                name="password"
                required
            >


            <button type="submit">
                Login
            </button>

        </form>


        <p>

            Don't have an account?

            <a href="register.php">
                Register here
            </a>

        </p>

    </div>

</body>

</html>