<?php
session_start();
$conn = require '../config/config.php';

    $strandname = $_POST['strandname'];
    $abbreviation = $_POST['abbreviation'];
    $status = $_POST['isactive'];


    $Query = "INSERT INTO strands (strandname, abbreviation, isactive) values ('$strandname','$abbreviation','$status')";

    if (mysqli_query($conn, $Query)) {
            $_SESSION['action-success'] = "Strand added.";
            header("Location: ../admin/strands.php");
            exit();
        }
        else {
            $_SESSION['action-error'] = "An error occurred.";
            header("Location: ../admin/strands.php");
            exit();
        }

?>