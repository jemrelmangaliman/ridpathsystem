<?php
session_start();
$conn = require '../config/config.php';

$sectionID = $_POST['section'];
$semesterID = $_POST['semester'];
$subjectID = $_POST['subject'];
$dayID = $_POST['dayname'];
$starttime = $_POST['starttime'];
$endtime = $_POST['endtime'];


$Query = "INSERT INTO classschedule (sectionID, semesterID, subjectID, dayID, starttime, endtime) values ('$sectionID','$semesterID','$subjectID','$dayID','$starttime','$endtime')";

if (mysqli_query($conn, $Query)) {
    $_SESSION['action-success'] = "Class Schedule added.";
    header("Location: ../admin/classSchedule.php");
    exit();
} else {
    $_SESSION['action-error'] = "An error occurred.";
    header("Location: ../admin/classSchedule.php");
    exit();
}
