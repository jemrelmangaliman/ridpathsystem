<?php
session_start();
$conn = require '../config/config.php';

    $interestname = $_POST['interestname'];
    $strand = $_POST['strand'];
    $status = $_POST['isactive'];


    $Query = "INSERT INTO interests (description, strandID, isactive) values ('$interestname','$strand','$status')";

    if (mysqli_query($conn, $Query)) {
            $_SESSION['action-success'] = "Interest added.";
            header("Location: ../admin/interests.php");
            exit();
        }
        else {
            $_SESSION['action-error'] = "An error occurred.";
            header("Location: ../admin/interests.php");
            exit();
        }

?>