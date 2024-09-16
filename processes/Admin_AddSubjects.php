<?php
session_start();
$conn = require '../config/config.php';

    $subjectname = $_POST['subjectname'];
    
    $status = $_POST['isactive'];


    $Query = "INSERT INTO subjects (subjectname, isactive) values ('$subjectname','$status')";

    if (mysqli_query($conn, $Query)) {
            $_SESSION['action-success'] = "subject added.";
            header("Location: ../admin/subject.php");
            exit();
        }
        else {
            $_SESSION['action-error'] = "An error occurred.";
            header("Location: ../admin/subject.php");
            exit();
        }

?>