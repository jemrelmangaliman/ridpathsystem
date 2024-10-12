<?php
session_start();
$conn = require '../config/config.php';

$sectionID = $_POST['section'];
$syID = $_POST['sy'];
$strandSubjectID = $_POST['strandsubject'];
$dayID = $_POST['day'];
$starttime = $_POST['starttime'];
$endtime = $_POST['endtime'];
$urlpath = '';

if (isset($_POST['AdminAddClassSchedule'])) {
    $urlpath = 'admin';
}
else if (isset($_POST['RegistrarAddClassSchedule'])) {
    $urlpath = 'registrar';
}

//get sy start date and end date
$SchoolYearData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM schoolyear WHERE schoolYearID = '$syID'"));
$formattedstartdate = $SchoolYearData['formattedstartdate'];
$formattedenddate = $SchoolYearData['formattedenddate'];

if (!isset($sectionID)) {
    $_SESSION['action-error'] = "Section is required";
    header("Location: ../".$urlpath."/class-schedules.php");
    exit(); 
}
if (!isset($syID)) {
    $_SESSION['action-error'] = "School Year is required";
    header("Location: ../".$urlpath."/class-schedules.php");
    exit(); 
}
if (!isset($strandSubjectID)) {
    $_SESSION['action-error'] = "Subject is required";
    header("Location: ../".$urlpath."/class-schedules.php");
    exit(); 
}
if (!isset($dayID)) {
    $_SESSION['action-error'] = "Day is required";
    header("Location: ../".$urlpath."/class-schedules.php");
    exit(); 
}

$Query = "INSERT INTO classschedule (sectionID, schoolYearID, strandSubjectID, dayID, starttime, endtime, formattedstartdate, formattedenddate) values ('$sectionID','$syID','$strandSubjectID','$dayID','$starttime','$endtime','$formattedstartdate','$formattedenddate')";

if (mysqli_query($conn, $Query)) {
    $_SESSION['action-success'] = "Class Schedule added.";
    header("Location: ../".$urlpath."/class-schedules.php");
    exit();
} else {
    $_SESSION['action-error'] = "An error occurred.";
    header("Location: ../".$urlpath."/class-schedules.php");
    exit();
}
