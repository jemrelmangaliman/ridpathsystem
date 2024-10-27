<?php

$conn = require '../config/config.php';

// Function to generate a random color in hex format
function generateRandomColor() {
    return '#' . str_pad(dechex(rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
}


$genderLabel = ['Male','Female','Other'];
$studentCount = [];
$colors = [];

foreach ($genderLabel as $gender) {
    $fetchStudentQuery = "SELECT gender FROM students WHERE gender = '$gender'";
    $fetchedStudentData = mysqli_query($conn, $fetchStudentQuery);
    $count = mysqli_num_rows($fetchedStudentData);
    $studentCount[] = $count;
    $colors[] = generateRandomColor();
}

$studentCountArray = [
    'labels' => $genderLabel,
    'data' => $studentCount,
    'backgroundColors' => $colors
];

header('Content-Type: application/json');
echo json_encode($studentCountArray);
?>