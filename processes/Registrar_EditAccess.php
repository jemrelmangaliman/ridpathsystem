<?php
session_start();
$conn = require '../config/config.php';

    $tempID = $_POST['studentID'];
    $access = $_POST['access'];


    $Query = "UPDATE students SET allowexam = '$access' WHERE tempID ='$tempID'";

    if (mysqli_query($conn, $Query)) {
            $_SESSION['action-success'] = "Exam access updated";
            header("Location: ../registrar/examaccess.php");
            exit();
        }
        else {
            $_SESSION['action-success'] = "An error occurred.";
            header("Location: ../registrar/examaccess.php");
            exit();
        }


?>