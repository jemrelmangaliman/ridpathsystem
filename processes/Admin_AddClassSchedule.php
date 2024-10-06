<?php
session_start();
$conn = require '../config/config.php';

$sectionID = $_POST['section'];
$semesterID = $_POST['semester'];
$strandSubjectID = $_POST['strandsubject'];
$dayID = $_POST['day'];
$starttime = $_POST['starttime'];
$endtime = $_POST['endtime'];


//get semester start date and end date
$SemesterData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM semester WHERE semesterID = '$semesterID'"));
$formattedstartdate = $SemesterData['formattedstartdate'];
$formattedenddate = $SemesterData['formattedenddate'];

if (!isset($sectionID)) {
    $_SESSION['action-error'] = "Section is required";
    header("Location: ../admin/class-schedules.php");
    exit(); 
}
if (!isset($semesterID)) {
    $_SESSION['action-error'] = "Semester is required";
    header("Location: ../admin/class-schedules.php");
    exit(); 
}
if (!isset($strandSubjectID)) {
    $_SESSION['action-error'] = "Subject is required";
    header("Location: ../admin/class-schedules.php");
    exit(); 
}
if (!isset($dayID)) {
    $_SESSION['action-error'] = "Day is required";
    header("Location: ../admin/class-schedules.php");
    exit(); 
}

$Query = "INSERT INTO classschedule (sectionID, semesterID, strandSubjectID, dayID, starttime, endtime, formattedstartdate, formattedenddate) values ('$sectionID','$semesterID','$strandSubjectID','$dayID','$starttime','$endtime','$formattedstartdate','$formattedenddate')";

if (mysqli_query($conn, $Query)) {
    $_SESSION['action-success'] = "Class Schedule added.";
    header("Location: ../admin/class-schedules.php");
    exit();
} else {
    $_SESSION['action-error'] = "An error occurred.";
    header("Location: ../admin/class-schedules.php");
    exit();
}
