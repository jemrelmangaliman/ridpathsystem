<?php
session_start();
$conn = require '../config/config.php';

    $username = $_POST['username'];
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $userRole = $_POST['userRole'];

    $fullname = $lastname . ", " . $firstname;
    $isActive = 1;

    $password = $lastname . '@2024';

    $Query = "INSERT INTO users (username, password, isActive, userRole, fullname, lastname, firstname) values ('$username','$password', '$isActive', '$userRole', '$fullname', '$lastname', '$firstname')";

    if (mysqli_query($conn, $Query)) {
            $_SESSION['action-success'] = "User added.";
            header("Location: ../admin/manageUserAccounts.php");
            exit();
        }
        else {
            $_SESSION['action-error'] = "An error occurred.";
            header("Location: ../admin/manageUserAccounts.php");
            exit();
        }

?>