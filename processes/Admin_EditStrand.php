<?php
session_start();
$conn = require '../config/config.php';

    $ID = $_POST['strandID'];
    $strandname = $_POST['strandname'];
    $abbreviation = $_POST['abbreviation'];
    $status = $_POST['isactive'];


    $Query = "UPDATE strands SET strandname='$strandname', abbreviation='$abbreviation', isactive='$status' WHERE strandID = '$ID'";

    if (mysqli_query($conn, $Query)) {
            $_SESSION['action-success'] = "Strand updated.";
            header("Location: ../admin/strands.php");
            exit();
        }
        else {
            $_SESSION['action-error'] = "An error occurred.";
            header("Location: ../admin/strands.php");
            exit();
        }

?>