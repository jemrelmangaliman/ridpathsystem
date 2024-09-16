<?php
session_start();
$conn = require '../config/config.php';

    $ID = $_POST['subjectID'];
    $subjectname = $_POST['subjectname'];
    $status = $_POST['isactive'];


    $Query = "UPDATE subjects SET subjectname='$subjectname', isactive='$status' WHERE subjectID = '$ID'";

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