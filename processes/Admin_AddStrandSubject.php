<?php
session_start();
$conn = require '../config/config.php';

    $strandID = $_POST['strand'];
    $subjectID = $_POST['subject'];
    $gradelevel = $_POST['gradelevel'];
    $syID = $_POST['sy'];
    $status = $_POST['isactive'];

    if($subjectID == 0 || $strandID == 0) {
        $_SESSION['action-error'] = "Please select a strand/subject.";
        header("Location: ../admin/strandsubjects.php");
        exit();
    }


    $Query = "INSERT INTO strandsubjects (strandID, subjectID, schoolYearID, gradelevel, isactive) values ('$strandID','$subjectID','$syID','$gradelevel','$status')";

    if (mysqli_query($conn, $Query)) {
            $_SESSION['action-success'] = "Subject has been added to the strand.";
            header("Location: ../admin/strandsubjects.php");
            exit();
        }
        else {
            $_SESSION['action-error'] = "An error occurred.";
            header("Location: ../admin/strandsubjects.php");
            exit();
        }

?>