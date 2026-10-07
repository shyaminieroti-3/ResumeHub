<?php
session_start();
include "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

$sql = "SELECT * FROM resumes
        WHERE user_id='$user_id'
        ORDER BY id DESC
        LIMIT 1";

$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("No resume found.");
}

$resume = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $education = $_POST["education"];
    $skills = $_POST["skills"];
    $experience = $_POST["experience"];
    $projects = $_POST["projects"];

    $id = $resume["id"];

    $sql = "UPDATE resumes SET
            full_name='$full_name',
            email='$email',
            phone='$phone',
            education='$education',
            skills='$skills',
            experience='$experience',
            projects='$projects'
            WHERE id='$id'
            AND user_id='$user_id'";

    if ($conn->query($sql) === TRUE) {

        header("Location: view_resume.php");
        exit();

    } else {

        echo "Error updating resume: " . $conn->error;

    }
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Edit Resume - ResumeHub</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<nav>

    <div class="logo">ResumeHub</div>

    <div class="nav-links">

        <a href="dashboard.php">Dashboard</a>

        <a href="view_resume.php">View Resume</a>

        <a href="logout.php">Logout</a>

    </div>

</nav>


<div class="resume-form">

    <h1>Edit Your Resume</h1>

    <form method="POST">

        <label>Full Name</label>

        <input
            type="text"
            name="full_name"
            value="<?php echo $resume["full_name"]; ?>"
            required
        >


        <label>Email</label>

        <input
            type="email"
            name="email"
            value="<?php echo $resume["email"]; ?>"
            required
        >


        <label>Phone</label>

        <input
            type="text"
            name="phone"
            value="<?php echo $resume["phone"]; ?>"
            required
        >


        <label>Education</label>

        <textarea
            name="education"
            rows="4"
            required
        ><?php echo $resume["education"]; ?></textarea>


        <label>Skills</label>

        <textarea
            name="skills"
            rows="4"
            required
        ><?php echo $resume["skills"]; ?></textarea>


        <label>Experience</label>

        <textarea
            name="experience"
            rows="4"
        ><?php echo $resume["experience"]; ?></textarea>


        <label>Projects</label>

        <textarea
            name="projects"
            rows="4"
        ><?php echo $resume["projects"]; ?></textarea>


        <button type="submit">
            Update Resume
        </button>

    </form>

</div>


<footer>

    <p>© 2026 ResumeHub. All Rights Reserved.</p>

</footer>

</body>

</html>