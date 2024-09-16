<?php
session_start();
$conn = require '../config/config.php';

    $ID = $_POST['enrollmentID'];


    $Query = "UPDATE enrollmentrecords SET enrollmentStatusID = 4 WHERE enrollmentID = '$ID'";

    if (mysqli_query($conn, $Query)) {
            $_SESSION['action-success'] = "Enrollment has been approved.";
            header("Location: ../registrar/pendingapproval.php");
            exit();
        }
        else {
            $_SESSION['action-error'] = "An error occurred.";
            header("Location: ../registrar/pendingapproval.php");
            exit();
        }

?>