<?php
session_start();
$conn = require '../config/config.php';

    $ID = $_POST['enrollmentID'];
    $returnpage = $_POST['returnpage'];
    $enrollmentremarks = $_POST['enrollmentremarks'];
    $validationmessage = "";

    if (isset($_POST['ApproveEnrollment'])) {
        $Query = "UPDATE enrollmentrecords SET enrollmentStatusID = 4, enrollmentremarks='$enrollmentremarks' WHERE enrollmentID = '$ID'";

                $validationmessage = "Enrollment has been approved.";
                ExecuteQuery ($conn, $Query, $validationmessage, $returnpage);

    }
    else if (isset($_POST['ReturnEnrollment'])) {
        $Query = "UPDATE enrollmentrecords SET enrollmentStatusID = 3, enrollmentremarks='$enrollmentremarks' WHERE enrollmentID = '$ID'";

                $validationmessage = "Enrollment has been returned for resubmission.";
                ExecuteQuery ($conn, $Query, $validationmessage, $returnpage);

    }
    else if (isset($_POST['HoldEnrollment'])) {
        $Query = "UPDATE enrollmentrecords SET enrollmentStatusID = 7, enrollmentremarks='$enrollmentremarks' WHERE enrollmentID = '$ID'";

                $validationmessage = "Enrollment has been put on hold.";
                ExecuteQuery ($conn, $Query, $validationmessage, $returnpage);
                
    }
    else if (isset($_POST['ConfirmBalanceSettlement'])) {

        $Query = "UPDATE enrollmentrecords SET enrollmentStatusID = 5, enrollmentremarks='$enrollmentremarks' WHERE enrollmentID = '$ID'";

                $validationmessage = "Balance settlement has been confirmed.";
                ExecuteQuery ($conn, $Query, $validationmessage, $returnpage);

    }
    else if (isset($_POST['ConfirmAdmission'])) {
        $studentnumber = $_POST['studentnumber'];
        $studentID = $_POST['studentID'];
        $section = $_POST['section'];
        $currentDate = date("Y-m-d");

        $Query = "UPDATE enrollmentrecords SET enrollmentStatusID = 6, enrollmentremarks='$enrollmentremarks', admissiondate='$currentDate' WHERE enrollmentID = '$ID'";

        //Update slot count of the section
        $SectionQuery = "UPDATE sections SET currentavailableslot = currentavailableslot-1 WHERE sectionID = '$section'";

        //Add student to the section's student list
        $SectionListQuery = "INSERT INTO sectionstudentlist (sectionID, studentID) VALUES ('$section','$studentID')";


        $StudentQuery = "UPDATE students SET studentnumber = '$studentnumber' WHERE tempID = '$studentID'";
        //set the student number of the student
        if (mysqli_query($conn, $StudentQuery));
        
        
        //execute sectionquery
        if (mysqli_query($conn, $SectionListQuery)){
            //execute sectionlistquery
            if (mysqli_query($conn, $SectionQuery)){
                $validationmessage = "Student is now enrolled.";
                ExecuteQuery ($conn, $Query, $validationmessage, $returnpage);
            }
            else {
                $_SESSION['action-error'] = "An error occurred.";
                header("Location: ../registrar/".$returnpage.".php");
                exit();
            }
        }
        else {
            $_SESSION['action-error'] = "An error occurred.";
            header("Location: ../registrar/".$returnpage.".php");
            exit();
        }
    
    }


    
    function ExecuteQuery ($conn, $Query, $validationmessage, $returnpage) {
        if (mysqli_query($conn, $Query)) {
            $_SESSION['action-success'] = $validationmessage;
            header("Location: ../registrar/".$returnpage.".php");
            exit();
        }
        else {
            $_SESSION['action-error'] = "An error occurred.";
            header("Location: ../registrar/".$returnpage.".php");
            exit();
        }   
    }

    
?>