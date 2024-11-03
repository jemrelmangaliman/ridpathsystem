<?php

$conn = require '../config/config.php';

// Function to generate a random color in hex format
function generateRandomColor() {
    return '#' . str_pad(dechex(rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
}


$genderLabel = ['Male','Female','Other'];
$studentCount = [];
$colors = [];

$activeSchoolYear = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM schoolyear where isactive = 'Yes'"));
$syID = $activeSchoolYear['schoolYearID'];

if (isset($_GET['id']) && $_GET['id'] != '0' && $_GET['id'] != '1') {
    $enrollmentstatus = $_GET['id'];
    $fetchStudentQuery = "SELECT st.gender FROM students st 
    LEFT JOIN enrollmentrecords er ON st.tempID = er.studentID
    LEFT JOIN enrollmentstatus es ON er.enrollmentStatusID = es.statusID
    WHERE es.statusID = '$enrollmentstatus' AND er.schoolYearID = '$syID' AND st.gender = ?";
}
else if (isset($_GET['id']) && $_GET['id'] == '1') {
    $enrollmentstatus = $_GET['id'];
    $fetchStudentQuery = "SELECT st.gender FROM students st 
    LEFT JOIN enrollmentrecords er ON st.tempID = er.studentID
    LEFT JOIN enrollmentstatus es ON er.enrollmentStatusID = es.statusID
    LEFT JOIN schoolyear sy ON er.schoolYearID = sy.schoolYearID
    WHERE (er.studentID IS NULL OR sy.isActive = 'No') AND st.gender = ? AND (es.statusID = '$enrollmentstatus' OR es.statusID IS NULL)";
}
else {
    $fetchStudentQuery = "SELECT gender FROM students WHERE gender = ?";
}

foreach ($genderLabel as $gender) {
    $stmt = $conn->prepare($fetchStudentQuery);
    $stmt->bind_param('s', $gender);

    $stmt->execute();
    $result = $stmt->get_result();
    $count = mysqli_num_rows($result);
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