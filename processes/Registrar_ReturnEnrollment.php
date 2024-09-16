<?php
session_start();
$conn = require '../config/config.php';

    $ID = $_POST['enrollmentID'];


    $Query = "UPDATE enrollmentrecords SET enrollmentStatusID = 3 WHERE enrollmentID = '$ID'";

    if (mysqli_query($conn, $Query)) {
            $_SESSION['action-success'] = "Enrollment has been returned for resubmission.";
            header("Location: ../registrar/pendingapproval.php");
            exit();
        }
        else {
            $_SESSION['action-error'] = "An error occurred.";
            header("Location: ../registrar/pendingapproval.php");
            exit();
        }

?>