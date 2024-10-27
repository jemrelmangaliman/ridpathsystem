<?php

$conn = require '../config/config.php';

// Store the strand names and enrollment counts
$SYNames = [];
$enrollmentCounts = [];


$fetchQuery = "SELECT * FROM schoolyear";
$fetchedData = mysqli_query($conn, $fetchQuery);
while ($DataArray = mysqli_fetch_assoc($fetchedData)) {
    $syID = $DataArray['schoolYearID'];
    $fetchEnrollmentRecords = mysqli_query($conn, "SELECT * FROM enrollmentrecords WHERE schoolYearID = '$syID' AND (enrollmentStatusID = 6 OR enrollmentStatusID = 7)");
    $syname = $DataArray['schoolyearname'];
    $enrollmentcount = mysqli_num_rows($fetchEnrollmentRecords);
        // Store the strand names and enrollment counts
        $SYNames[] = $syname;
        $enrollmentCounts[] = $enrollmentcount;
}

$studentCountArray = [
    'labels' => $SYNames,
    'data' => $enrollmentCounts
];

header('Content-Type: application/json');
echo json_encode($studentCountArray);
?>