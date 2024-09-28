<?php
session_start();
$conn = require '../config/config.php';

    $subjectname = $_POST['subjectname'];
    $prerequisite = $_POST['prerequisite'];
    
    $status = $_POST['isactive'];

    $checkExistence = mysqli_query($conn, "SELECT * FROM subjects WHERE subjectname = '$subjectname'");
    
    if(mysqli_num_rows($checkExistence) > 0) {
        $_SESSION['action-error'] = "Subject name already exists.";
        header("Location: ../admin/subject.php");
        exit();
    }

    $Query = "INSERT INTO subjects (pr_subjectID, subjectname, isactive) values ('$prerequisite','$subjectname','$status')";

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