<?php
session_start();
$conn = require '../config/config.php';

    $semestername = $_POST['semestername'];
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $status = $_POST['isactive'];


    $Query = "INSERT INTO semester (semestername, startdate, enddate, isactive) values ('$semestername','$startdate','$enddate','$status')";

    if (mysqli_query($conn, $Query)) {
            $_SESSION['action-success'] = "semester added.";
            header("Location: ../admin/semester.php");
            exit();
        }
        else {
            $_SESSION['action-error'] = "An error occurred.";
            header("Location: ../admin/semester.php");
            exit();
        }

?>