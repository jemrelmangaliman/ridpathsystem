<?php
session_start();
$conn = require '../config/config.php';

    $strandSubjectID = $_POST['strandSubjectID'];
    $strandID = $_POST['strand'];
    $subjectID = $_POST['subject'];
    $syID = $_POST['sy'];
    $gradelevel = $_POST['gradelevel'];
    $status = $_POST['isactive'];


    $Query = "UPDATE strandsubjects SET strandID = '$strandID', subjectID = '$subjectID', schoolYearID='$syID', gradelevel='$gradelevel', isactive='$status' WHERE strandSubjectID = '$strandSubjectID'";

    if (mysqli_query($conn, $Query)) {
            $_SESSION['action-success'] = "Strand subject has been updated.";
            header("Location: ../admin/strandsubjects.php");
            exit();
        }
        else {
            $_SESSION['action-error'] = "An error occurred.";
            header("Location: ../admin/strandsubjects.php");
            exit();
        }

?>