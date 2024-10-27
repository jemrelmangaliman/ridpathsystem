<?php
$conn = require '../config/config.php';
session_start();

//select all the sections
$SectionList = mysqli_query($conn, "SELECT * FROM sections");
while ($sectionData = mysqli_fetch_assoc($SectionList)) {
    $sectionID = $sectionData['sectionID'];

    //get the section's default slot count
    $SectionDetails = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM sections WHERE sectionID='$sectionID'"));
    $defaultslot = $SectionDetails['defaultslots'];
    
    //reset the section's available slot
    $query = "UPDATE sections SET currentavailableslot='$defaultslot' WHERE sectionID='$sectionID'";
    
    //delete the student list of the section
    mysqli_query($conn, "DELETE FROM sectionstudentlist WHERE sectionID = '$sectionID'");
    
    //update the section list count to default
    mysqli_query($conn, $query);
 
}

$_SESSION['action-success'] = "Student list has been successfully cleared.";
header("Location: ../registrar/class-students.php");
exit();
?>