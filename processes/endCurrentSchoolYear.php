<?php
$conn = require '../config/config.php';
session_start();

$syID = $_POST['syID'];

//update the current school year to inactive
mysqli_query($conn, "UPDATE schoolyear SET isactive = 'No' WHERE schoolYearID = '$syID'");

//disable exam access to all students
mysqli_query($conn, "UPDATE students SET allowexam = 'No'");

//Update all enrollment records with 'Enrolled' status to 'Completed'
mysqli_query($conn, "UPDATE enrollmentrecords SET enrollmentStatusID = 9 WHERE enrollmentStatusID = 6 and schoolYearID = '$syID'");

//Update remaining enrollment records with other enrollment status to 'Cancelled'
mysqli_query($conn, "UPDATE enrollmentrecords SET enrollmentStatusID = 8 WHERE (enrollmentStatusID <> 6 AND enrollmentStatusID <> 9) and schoolYearID = '$syID'");


//clear all section list
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

$_SESSION['action-success'] = "School Year has been ended. Please configure the system for another school year.";
header("Location: ../admin/endcurrentschoolyear.php");
exit();
?>