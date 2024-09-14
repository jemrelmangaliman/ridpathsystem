<?php
session_start();
$conn = require '../config/config.php';

    $userID = $_POST['userID'];
    $username = $_POST['username'];
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $userRole = $_POST['userRole'];
    $fullname = $lastname . ", " . $firstname;

    $Query = "UPDATE users SET username='$username', userRole='$userRole', fullname='$fullname', lastname='$lastname', firstname='$firstname' WHERE userID='$userID'";

    if (mysqli_query($conn, $Query)) {
            $_SESSION['action-success'] = "Profile Updated.";
            header("Location: ../admin/profile.php");
            exit();
        }
        else {
            $_SESSION['action-error'] = "An error occurred.";
            header("Location: ../admin/profile.php");
            exit();
        }


?>