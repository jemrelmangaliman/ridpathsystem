<?php
$conn = require '../config/config.php';
session_start();

$sectionID = $_POST['section'];

//get the section's default slot count
$SectionDetails = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM sections WHERE sectionID='$sectionID'"));
$defaultslot = $SectionDetails['defaultslots'];

//reset the section's available slot
$query = "UPDATE sections SET currentavailableslot='$defaultslot' WHERE sectionID='$sectionID'";


//delete the students in the student list
if (mysqli_query($conn, "DELETE FROM sectionstudentlist WHERE sectionID = '$sectionID'")){

    //reset the available slots of the section
    if (mysqli_query($conn, $query)){
        $_SESSION['action-success'] = "Student list has been successfully cleared.";
        header("Location: ../registrar/class-students.php");
        exit();
    }
    else {
        $_SESSION['action-error'] = "An error occurred.";
        header("Location: ../registrar/class-students.php");
        exit();
    }
}
else {
    $_SESSION['action-error'] = "An error occurred.";
    header("Location: ../registrar/class-students.php");
    exit();
}

?>