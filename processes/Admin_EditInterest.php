<?php
session_start();
$conn = require '../config/config.php';

    $ID = $_POST['interestID'];
    $interestname = $_POST['interestname'];
    $strand = $_POST['strand'];
    $status = $_POST['isactive'];


    $Query = "UPDATE interests SET description='$interestname', strandID='$strand', isactive='$status' WHERE interestID = '$ID'";

    if (mysqli_query($conn, $Query)) {
            $_SESSION['action-success'] = "Interest updated.";
            header("Location: ../admin/interests.php");
            exit();
        }
        else {
            $_SESSION['action-error'] = "An error occurred.";
            header("Location: ../admin/interests.php");
            exit();
        }

?>