<?php
session_start();
$conn = require '../config/config.php';

    $sectionname = $_POST['sectionname'];
    
    $status = $_POST['isactive'];


    $Query = "INSERT INTO sections (sectionname, isActive) values ('$sectionname','$status')";

    if (mysqli_query($conn, $Query)) {
            $_SESSION['action-success'] = "Section added.";
            header("Location: ../admin/section.php");
            exit();
        }
        else {
            $_SESSION['action-error'] = "An error occurred.";
            header("Location: ../admin/section.php");
            exit();
        }

?>