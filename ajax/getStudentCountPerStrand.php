<?php

$conn = require '../config/config.php';

// Store the strand names and enrollment counts
$strandAbb = [];
$enrollmentCounts = [];

$fetchQuery = "SELECT * FROM strands";
$fetchedData = mysqli_query($conn, $fetchQuery);
while ($DataArray = mysqli_fetch_assoc($fetchedData)) {
    $strandID = $DataArray['strandID'];
    $fetchEnrollmentRecords = mysqli_query($conn, "SELECT * FROM enrollmentrecords WHERE strandID = '$strandID' AND (enrollmentStatusID = 6)");
    $abbreviation = $DataArray['abbreviation'];
    $enrollmentcount = mysqli_num_rows($fetchEnrollmentRecords);
        // Store the strand names and enrollment counts
        $strandAbb[] = $abbreviation;
        $enrollmentCounts[] = $enrollmentcount;
}

$studentCountArray = [
    'labels' => $strandAbb,
    'data' => $enrollmentCounts
];

header('Content-Type: application/json');
echo json_encode($studentCountArray);
?>