<?php

$conn = require '../config/config.php';

// Function to generate a random color in hex format
function generateRandomColor() {
    return '#' . str_pad(dechex(rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
}

$enrollmentstatus = null;
$fetchStudentQuery = '';
$ageLabel = [];
$ages = [];
$studentCount = [];
$colors = [];

$activeSchoolYear = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM schoolyear where isactive = 'Yes'"));
$syID = $activeSchoolYear['schoolYearID'];

$fetchQuery = "SELECT birthday,FLOOR(DATEDIFF(CURDATE(), birthday) / 365.25) AS age FROM students GROUP BY age ORDER BY age ASC";
$fetchedData = mysqli_query($conn, $fetchQuery);
while ($DataArray = mysqli_fetch_assoc($fetchedData)) {
    $ageLabel[] = $DataArray['age'].' Years';
    $ages[] = $DataArray['age'];
    $colors[] = generateRandomColor();
}


if (isset($_GET['id']) && $_GET['id'] != '0' && $_GET['id'] != '1') {
    $enrollmentstatus = $_GET['id'];
    $fetchStudentQuery = "SELECT st.birthday,FLOOR(DATEDIFF(CURDATE(), st.birthday) / 365.25) AS age FROM students st 
    LEFT JOIN enrollmentrecords er ON st.tempID = er.studentID
    LEFT JOIN enrollmentstatus es ON er.enrollmentStatusID = es.statusID
    WHERE es.statusID = '$enrollmentstatus' AND er.schoolYearID = '$syID' AND FLOOR(DATEDIFF(CURDATE(), birthday) / 365.25) = ?";
}
else if (isset($_GET['id']) && $_GET['id'] == '1') {
    $enrollmentstatus = $_GET['id'];
    $fetchStudentQuery = "SELECT st.birthday,FLOOR(DATEDIFF(CURDATE(), st.birthday) / 365.25) AS age FROM students st 
    LEFT JOIN enrollmentrecords er ON st.tempID = er.studentID
    LEFT JOIN enrollmentstatus es ON er.enrollmentStatusID = es.statusID
    LEFT JOIN schoolyear sy ON er.schoolYearID = sy.schoolYearID
    WHERE (er.studentID IS NULL OR sy.isActive = 'No') AND FLOOR(DATEDIFF(CURDATE(), birthday) / 365.25) = ? AND (es.statusID = '$enrollmentstatus' OR es.statusID IS NULL)";
}
else {
    $fetchStudentQuery = "SELECT birthday,FLOOR(DATEDIFF(CURDATE(), birthday) / 365.25) AS age FROM students WHERE FLOOR(DATEDIFF(CURDATE(), birthday) / 365.25) = ?";
}

foreach ($ages as $age) {
    $stmt = $conn->prepare($fetchStudentQuery);
    $stmt->bind_param('i', $age);

    $stmt->execute();
    $result = $stmt->get_result();
    $count = mysqli_num_rows($result);
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