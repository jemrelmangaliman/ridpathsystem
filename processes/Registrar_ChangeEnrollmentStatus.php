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
        $isgenerated = $_POST['isgenerated'];
        $studentcount = $_POST['studentcount'];
        $studentID = $_POST['studentID'];
        $syID = $_POST['syID'];
        $section = $_POST['section'];
        $currentDate = date("Y-m-d");

        $totalpaidamount = 0;
        $GetPaymentRecordsQuery = "SELECT * FROM paymentrecord WHERE enrollmentID='$ID'";
        $GetPaymentRecord = mysqli_query($conn, $GetPaymentRecordsQuery);
        while ($PaymentDetail = mysqli_fetch_assoc($GetPaymentRecord)) {
            $totalpaidamount += $PaymentDetail['totalpaymentamount'];
        }

        $fetchQuery = "SELECT * FROM enrollmentrecords ER
        LEFT JOIN strands SD ON SD.strandID = ER.strandID
        LEFT JOIN tuitionfees TF ON TF.strandID = SD.strandID
        WHERE ER.enrollmentID = '$ID'";
        $fetchedData = mysqli_query($conn, $fetchQuery);
        $DataArray = mysqli_fetch_assoc($fetchedData);
        $tuitionfee = $DataArray['amount'];
        $paymentterm =$DataArray['paymentterm'];
        $strandID =$DataArray['strandID'];

        //get misc fee total using fetched strand ID in the first query
        $MiscFeeData = mysqli_query($conn, "SELECT * FROM miscellaneousfees WHERE strandID='$strandID'");
        $totalamount = 0;
        $totalamount += $tuitionfee; //add the tuition fee to the total amount
        $miscfeetext = '';


        while ($Data = mysqli_fetch_assoc($MiscFeeData)) {
            $amount = $Data['amount'];
            $totalamount += $amount; //add the misc fee to the total
            $description = $Data['description'];
            $miscfeetext .= '<br><small style="font-size: 13px;">₱'.$amount.' - '.$description.'</small>';   
        }


        $Query = '';
        if ($paymentterm == 'Partial') {
            if ($totalpaidamount >= $totalamount) {
                $Query = "UPDATE enrollmentrecords SET enrollmentStatusID = 6, enrollmentremarks='$enrollmentremarks', admissiondate='$currentDate' WHERE enrollmentID = '$ID'";
            }
            else {
                $Query = "UPDATE enrollmentrecords SET enrollmentStatusID = 10, enrollmentremarks='$enrollmentremarks', admissiondate='$currentDate' WHERE enrollmentID = '$ID'";
            }  
        }
        else {
            $Query = "UPDATE enrollmentrecords SET enrollmentStatusID = 6, enrollmentremarks='$enrollmentremarks', admissiondate='$currentDate' WHERE enrollmentID = '$ID'";

        }
        
        //Update slot count of the section
        $SectionQuery = "UPDATE sections SET currentavailableslot = currentavailableslot-1 WHERE sectionID = '$section'";

        //Add student to the section's student list
        $SectionListQuery = "INSERT INTO sectionstudentlist (sectionID, studentID) VALUES ('$section','$studentID')";


        $StudentQuery = "UPDATE students SET studentnumber = '$studentnumber' WHERE tempID = '$studentID'";
        //set the student number of the student
        mysqli_query($conn, $StudentQuery);
        
        if ($isgenerated) {
            mysqli_query($conn, "UPDATE schoolyear SET studentcount = '$studentcount' WHERE schoolYearID = '$syID'");

        }

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