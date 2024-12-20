<?php
session_start();
$conn = require '../config/config.php';

$classID = $_POST['classID'];
$sectionID = $_POST['section'];
$syID = $_POST['sy'];
$strandSubjectID = $_POST['strandsubject'];
$dayID = $_POST['day'];
$starttime = $_POST['starttime'];
$endtime = $_POST['endtime'];
$urlpath = '';

if (isset($_POST['AdminEditClassSchedule'])) {
    $urlpath = 'admin';
}
else if (isset($_POST['RegistrarEditClassSchedule'])) {
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

$Query = "UPDATE classschedule SET sectionID='$sectionID', schoolYearID='$syID', strandSubjectID='$strandSubjectID', dayID='$dayID', starttime='$starttime', endtime='$endtime', formattedstartdate='$formattedstartdate', formattedenddate='$formattedenddate' WHERE classID = '$classID'";

if (mysqli_query($conn, $Query)) {
    $_SESSION['action-success'] = "Class Schedule updated.";
    header("Location: ../".$urlpath."/class-schedules.php");
    exit();
} else {
    $_SESSION['action-error'] = "An error occurred.";
    header("Location: ../".$urlpath."/class-schedules.php");
    exit();
}
