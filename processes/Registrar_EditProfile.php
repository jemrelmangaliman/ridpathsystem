<?php
session_start();
$conn = require '../config/config.php';

    $userID = $_POST['userID'];
    $username = $_POST['username'];
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $userRole = $_POST['userRole'];
    $fullname = $lastname . ", " . $firstname;
    date_default_timezone_set('Asia/Manila');
    $currentDateTime = date('Y-m-d H:i:s');

    $Query = "UPDATE users SET username='$username', userRole='$userRole', fullname='$fullname', lastname='$lastname', firstname='$firstname' WHERE userID='$userID'";

    if (mysqli_query($conn, $Query)) {
            $_SESSION['action-success'] = "Notification: Profile Updated on ".$currentDateTime;
            $_SESSION['action-error'] = "";
            $_SESSION['logged_username'] = $lastname.', '.$firstname;
            header("Location: ../registrar/profile.php");
            exit();
        }
        else {
            $_SESSION['action-error'] = "Warning: An error occurred on ".$currentDateTime;
            $_SESSION['action-success'] = "";
            header("Location: ../registrar/profile.php");
            exit();
        }


?>