<?php
session_start();
include "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

$sql = "SELECT * FROM resumes WHERE user_id='$user_id' ORDER BY id DESC LIMIT 1";

$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("No resume found. Please create a resume first.");
}

$resume = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>

<head>

    <title>My Resume - ResumeHub</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<nav>

    <div class="logo">ResumeHub</div>

    <div class="nav-links">

        <a href="dashboard.php">Dashboard</a>

        <a href="add_resume.php">Create Resume</a>

        <a href="logout.php">Logout</a>

    </div>

</nav>


<div class="resume">

    <div class="resume-header">

        <h1><?php echo $resume["full_name"]; ?></h1>

        <p>
            <?php echo $resume["email"]; ?>
            |
            <?php echo $resume["phone"]; ?>
        </p>

    </div>


    <div class="resume-section">

        <h2>Education</h2>

        <p>
            <?php echo nl2br($resume["education"]); ?>
        </p>

    </div>


    <div class="resume-section">

        <h2>Skills</h2>

        <p>
            <?php echo nl2br($resume["skills"]); ?>
        </p>

    </div>


    <div class="resume-section">

        <h2>Experience</h2>

        <p>
            <?php echo nl2br($resume["experience"]); ?>
        </p>

    </div>


    <div class="resume-section">

        <h2>Projects</h2>

        <p>
            <?php echo nl2br($resume["projects"]); ?>
        </p>

    </div>


    <div class="resume-buttons">

        <a href="edit_resume.php" class="btn">
            Edit Resume
        </a>

        <a href="delete_resume.php"
           class="btn delete-btn"
           onclick="return confirm('Are you sure you want to delete your resume?');">
            Delete Resume
        </a>

    </div>

</div>


<footer>

    <p>© 2026 ResumeHub. All Rights Reserved.</p>

</footer>

</body>

</html>