<?php
session_start();
$conn = require '../config/config.php';

$studentID = $_SESSION['user_id'];
$schedules = array();

//get current user's section
$CurrentUserData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM sectionstudentlist WHERE studentID = '$studentID'"));
$sectionID = $CurrentUserData['sectionID'];

//fetch tudent's class schedules from database
$getSchedules  = mysqli_query($conn, "SELECT * FROM classschedule cs
LEFT JOIN strandsubjects ssb ON cs.strandSubjectID = ssb.strandSubjectID
LEFT JOIN subjects sj ON ssb.subjectID = sj.subjectID
WHERE cs.sectionID = '$sectionID'");

while ($row = mysqli_fetch_assoc($getSchedules)) {
        $schedules[] = array(
            'id' => $row['classID'],
            'title' => $row['subjectname'],
            'daysOfWeek' => $row['dayID'],
            'startRecur' => $row['formattedstartdate'],
            'endRecur' => $row['formattedenddate'], 
            'startTime' => $row['starttime'],
            'endTime' => $row['endtime']
        );   
}

// Convert data to JSON
echo json_encode($schedules);
?>