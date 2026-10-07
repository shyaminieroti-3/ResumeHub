<?php
session_start();
include "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_id = $_SESSION["user_id"];

    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $education = $_POST["education"];
    $skills = $_POST["skills"];
    $experience = $_POST["experience"];
    $projects = $_POST["projects"];

    $sql = "INSERT INTO resumes
            (user_id, full_name, email, phone, education, skills, experience, projects)
            VALUES
            ('$user_id', '$full_name', '$email', '$phone', '$education', '$skills', '$experience', '$projects')";

    if ($conn->query($sql) === TRUE) {

        $message = "Resume created successfully!";

    } else {

        $message = "Error: " . $conn->error;

    }
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Create Resume - ResumeHub</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<nav>

    <div class="logo">ResumeHub</div>

    <div class="nav-links">

        <a href="dashboard.php">Dashboard</a>

        <a href="logout.php">Logout</a>

    </div>

</nav>


<div class="resume-form">

    <h1>Create Your Resume</h1>

    <?php

    if ($message != "") {
        echo "<p class='success'>$message</p>";
    }

    ?>


    <form method="POST">

        <label>Full Name</label>

        <input
            type="text"
            name="full_name"
            required
        >


        <label>Email</label>

        <input
            type="email"
            name="email"
            required
        >


        <label>Phone</label>

        <input
            type="text"
            name="phone"
            required
        >


        <label>Education</label>

        <textarea
            name="education"
            rows="4"
            required
        ></textarea>


        <label>Skills</label>

        <textarea
            name="skills"
            rows="4"
            placeholder="Example: HTML, CSS, PHP, MySQL"
            required
        ></textarea>


        <label>Experience</label>

        <textarea
            name="experience"
            rows="4"
        ></textarea>


        <label>Projects</label>

        <textarea
            name="projects"
            rows="4"
        ></textarea>


        <button type="submit">
            Save Resume
        </button>

    </form>

</div>


<footer>

    <p>© 2026 ResumeHub. All Rights Reserved.</p>

</footer>

</body>

</html>