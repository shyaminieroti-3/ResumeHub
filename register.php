<?php
include "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $hashed_password = sha1($password);

    $sql = "INSERT INTO users (name, email, password)
            VALUES ('$name', '$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        $message = "Registration successful!";
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Register - ResumeHub</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <nav>
        <div class="logo">ResumeHub</div>

        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="login.php">Login</a>
        </div>
    </nav>

    <div class="form-container">

        <h2>Create Your Account</h2>

        <?php
        if ($message != "") {
            echo "<p>$message</p>";
        }
        ?>

        <form method="POST">

            <label>Name</label>
            <input type="text" name="name" required>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit">Register</button>

        </form>

        <p>
            Already have an account?
            <a href="login.php">Login here</a>
        </p>

    </div>

</body>
</html>