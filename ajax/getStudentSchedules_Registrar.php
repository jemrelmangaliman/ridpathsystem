<?php
session_start();
$conn = require '../config/config.php';

$sectionID = $_GET['ID'];
$schedules = array();

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