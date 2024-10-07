<?php
session_start();
$conn = require '../config/config.php';

    $userID = $_POST['userID'];
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $email = $_POST['email'];
    $contactnumber = $_POST['contactnumber'];
    date_default_timezone_set('Asia/Manila');
    $currentDateTime = date('Y-m-d H:i:s');
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $address= $_POST['address'];

    $Query = "UPDATE students SET lastname='$lastname', firstname='$firstname', middlename='$middlename', email='$email', contactnumber='$contactnumber', gender='$gender', birthday='$birthday', address='$address' WHERE tempID='$userID'";

    if (mysqli_query($conn, $Query)) {
            $_SESSION['action-success'] = "Notification: Profile Updated on ".$currentDateTime;
            $_SESSION['logged_username'] = $lastname.', '.$firstname;
            header("Location: ../student/profile.php");
            exit();
        }
        else {
            $_SESSION['action-error'] = "Warning: An error occurred on ".$currentDateTime;
            header("Location: ../student/profile.php");
            exit();
        }


?>