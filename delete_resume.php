<?php

session_start();
include "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

$sql = "DELETE FROM resumes WHERE user_id='$user_id'";

if ($conn->query($sql) === TRUE) {

    header("Location: dashboard.php");
    exit();

} else {

    echo "Error deleting resume: " . $conn->error;

}

?>