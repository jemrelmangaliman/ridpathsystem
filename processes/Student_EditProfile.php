<?php
session_start();
$conn = require '../config/config.php';

    $userID = $_POST['userID'];
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $email = $_POST['email'];
    $contactnumber = $_POST['contactnumber'];

    $Query = "UPDATE students SET lastname='$lastname', firstname='$firstname', middlename='$middlename', email='$email', contactnumber='$contactnumber' WHERE tempID='$userID'";

    if (mysqli_query($conn, $Query)) {
            $_SESSION['action-success'] = "Profile Updated.";
            header("Location: ../student/profile.php");
            exit();
        }
        else {
            $_SESSION['action-error'] = "An error occurred.";
            header("Location: ../student/profile.php");
            exit();
        }


?>