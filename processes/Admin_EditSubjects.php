<?php
session_start();
$conn = require '../config/config.php';

    $ID = $_POST['subjectID'];
    $subjectname = $_POST['subjectname'];
    $pr_subjectID = $_POST['prerequisite'];
    $status = $_POST['isactive'];

    $checkExistence = mysqli_query($conn, "SELECT * FROM subjects WHERE subjectname = '$subjectname' AND subjectID <> '$ID'");
    
    if(mysqli_num_rows($checkExistence) > 0) {
        $_SESSION['action-error'] = "Subject name already exists.";
        header("Location: ../admin/subject.php");
        exit();
    }

    $Query = "UPDATE subjects SET subjectname='$subjectname', pr_subjectID = '$pr_subjectID', isactive='$status' WHERE subjectID = '$ID'";

    if (mysqli_query($conn, $Query)) {
            $_SESSION['action-success'] = "Subject updated.";
            header("Location: ../admin/subject.php");
            exit();
        }
        else {
            $_SESSION['action-error'] = "An error occurred.";
            header("Location: ../admin/subject.php");
            exit();
        }

?>