<?php
session_start();
include "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

$sql = "SELECT * FROM resumes WHERE user_id='$user_id' LIMIT 1";
$result = $conn->query($sql);

$has_resume = ($result->num_rows > 0);
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - ResumeHub</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<nav>

    <div class="logo">
        ResumeHub
    </div>

    <div class="nav-links">

        <a href="dashboard.php">Dashboard</a>

        <a href="index.php">Home</a>

        <a href="logout.php">Logout</a>

    </div>

</nav>


<div class="dashboard">

    <h1>
        Welcome, <?php echo $_SESSION["user_name"]; ?>!
    </h1>

    <p>
        Manage your professional resume from your dashboard.
    </p>


    <div class="dashboard-card">

        <?php if ($has_resume) { ?>

    <h2>Your Resume</h2>

    <p>
        Your resume has been created.
    </p>

    <a href="add_resume.php" class="btn">
        Create Resume
    </a>

    <a href="view_resume.php" class="btn">
        View My Resume
    </a>

    <a href="edit_resume.php" class="btn">
        Edit Resume
    </a>

        <?php } else { ?>

            <h2>Create Your Resume</h2>

            <p>
                You haven't created a resume yet.
            </p>

            <a href="add_resume.php" class="btn">
                Create Resume
            </a>

        <?php } ?>

    </div>

</div>


<footer>

    <p>
        © 2026 ResumeHub. All Rights Reserved.
    </p>

</footer>

</body>

</html>