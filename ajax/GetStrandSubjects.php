<?php

$conn = require '../config/config.php';

$sectionID = $_GET['id'];
$SectionQuery = mysqli_query($conn, "SELECT * FROM sections WHERE sectionID= '$sectionID'");
$SectionData = mysqli_fetch_assoc($SectionQuery);
$strandID = $SectionData['strandID'];

$strandSubjectArray = [];
$fetchQuery = "SELECT * FROM strandsubjects ss LEFT JOIN subjects sb ON ss.subjectID = sb.subjectID WHERE ss.isactive = 'Yes' AND ss.strandID = '$strandID' ORDER BY sb.subjectname ASC";
$fetchedData = mysqli_query($conn, $fetchQuery);
while ($DataArray = mysqli_fetch_assoc($fetchedData)) {
    $strandSubjectArray[] = ["strandSubjectID" => $DataArray['strandSubjectID'], "subjectname" => $DataArray['subjectname']];
}

header('Content-Type: application/json');
echo json_encode($strandSubjectArray);
?>