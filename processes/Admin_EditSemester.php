<?php
session_start();
$conn = require '../config/config.php';

    $ID = $_POST['semesterID'];
    $semestername = $_POST['semestername'];
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $status = $_POST['isactive'];
    $formattedstartdate = $startdate."T00:00:00";
    $formattedenddate = $enddate."T23:59:59";



    $Query = "UPDATE semester SET semestername='$semestername', startdate='$startdate', enddate='$enddate', formattedstartdate = '$formattedstartdate', formattedenddate='$formattedenddate', isactive='$status' WHERE semesterID = '$ID'";

    if (mysqli_query($conn, $Query)) {
            $_SESSION['action-success'] = "semester updated.";
            header("Location: ../admin/semester.php");
            exit();
        }
        else {
            $_SESSION['action-error'] = "An error occurred.";
            header("Location: ../admin/semester.php");
            exit();
        }

?>