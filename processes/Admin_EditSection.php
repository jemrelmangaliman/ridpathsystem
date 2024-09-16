<?php
session_start();
$conn = require '../config/config.php';

    $ID = $_POST['sectionID'];
    $sectionname = $_POST['sectionname'];
    $status = $_POST['isactive'];


    $Query = "UPDATE sections SET sectionname='$sectionname', isactive='$status' WHERE sectionID = '$ID'";

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