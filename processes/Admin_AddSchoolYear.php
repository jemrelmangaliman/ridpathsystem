<?php
session_start();
$conn = require '../config/config.php';

    $syname = $_POST['syname'];
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $status = $_POST['isactive'];
    $formattedstartdate = $startdate."T00:00:00";
    $formattedenddate = $enddate."T23:59:59";


    if($status == "Yes") {
        //check if there's any active school year
        $checkSY = mysqli_query($conn, "SELECT * FROM schoolyear WHERE isactive='Yes'");
        if(mysqli_num_rows($checkSY) > 0) {
            $_SESSION['action-error'] = "Only one School Year can be activated.";
            header("Location: ../admin/schoolyear.php");
            exit();
        }
    }
    $Query = "INSERT INTO schoolyear (schoolyearname, startdate, enddate, formattedstartdate, formattedenddate, isactive) values ('$syname','$startdate','$enddate','$formattedstartdate','$formattedenddate','$status')";

    if (mysqli_query($conn, $Query)) {
            $_SESSION['action-success'] = "School year added.";
            header("Location: ../admin/schoolyear.php");
            exit();
        }
        else {
            $_SESSION['action-error'] = "An error occurred.";
            header("Location: ../admin/schoolyear.php");
            exit();
        }

?>