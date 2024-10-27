<?php

$conn = require '../config/config.php';

// Function to generate a random color in hex format
function generateRandomColor() {
    return '#' . str_pad(dechex(rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
}


$ageLabel = [];
$ages = [];
$studentCount = [];
$colors = [];

$fetchQuery = "SELECT birthday,FLOOR(DATEDIFF(CURDATE(), birthday) / 365.25) AS age FROM students GROUP BY age ORDER BY age ASC";
$fetchedData = mysqli_query($conn, $fetchQuery);
while ($DataArray = mysqli_fetch_assoc($fetchedData)) {
    $ageLabel[] = $DataArray['age'].' Years';
    $ages[] = $DataArray['age'];
    $colors[] = generateRandomColor();
}

foreach ($ages as $age) {
    $fetchStudentQuery = "SELECT birthday,FLOOR(DATEDIFF(CURDATE(), birthday) / 365.25) AS age FROM students WHERE FLOOR(DATEDIFF(CURDATE(), birthday) / 365.25) = '$age'";
    $fetchedStudentData = mysqli_query($conn, $fetchStudentQuery);
    $count = mysqli_num_rows($fetchedStudentData);
    $studentCount[] = $count;
}

$studentCountArray = [
    'labels' => $ageLabel,
    'data' => $studentCount,
    'backgroundColors' => $colors
];

header('Content-Type: application/json');
echo json_encode($studentCountArray);
?>