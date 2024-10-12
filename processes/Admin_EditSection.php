<?php
session_start();
$conn = require '../config/config.php';

    $ID = $_POST['sectionID'];
    $sectionname = $_POST['sectionname'];
    $strandID = $_POST['strand'];
    $gradelevel = $_POST['gradelevel'];
    $status = $_POST['isactive'];
    $defaultslots = $_POST['defaultslots'];
    $availableslots = $_POST['availableslots'];


    $Query = "UPDATE sections SET sectionname='$sectionname', strandID='$strandID', gradelevel='$gradelevel', defaultslots='$defaultslots', currentavailableslot = '$availableslots', isactive='$status' WHERE sectionID = '$ID'";

    if (mysqli_query($conn, $Query)) {
            $_SESSION['action-success'] = "Section updated.";
            header("Location: ../admin/section.php");
            exit();
        }
        else {
            $_SESSION['action-error'] = "An error occurred.";
            header("Location: ../admin/section.php");
            exit();
        }

?>