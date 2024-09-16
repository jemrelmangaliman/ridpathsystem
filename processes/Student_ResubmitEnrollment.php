<?php
session_start();
$conn = require '../config/config.php';

    $ID = $_POST['enrollmentID'];


    $Query = "UPDATE strands SET enrollmentStatusID = 2 WHERE enrollmentID = '$ID'";

    if (mysqli_query($conn, $Query)) {
            $_SESSION['action-success'] = "Enrollment has been resubmitted.";
            header("Location: ../student/admission.php");
            exit();
        }
        else {
            $_SESSION['action-error'] = "An error occurred.";
            header("Location: ../student/admission.php");
            exit();
        }

?>