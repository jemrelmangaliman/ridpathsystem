<?php
session_start();
$conn = require '../config/config.php';


//process starts here
$studentid = $_SESSION['user_id'];
$enrollmentID = $_POST['enrollmentID'];
$paymentmode = $_POST['paymentmode'];
$paymenttype = $_POST['paymenttype'];
$amount = $_POST['amount'];
$paymentremarks = (isset($_POST['paymentremarks'])) ? $_POST['paymentremarks'] : "";
$paymentterm = $_POST['paymentterm'];
$Query = '';
$currentdate = date('Y-m-d');
    if ($paymenttype == "Online") {
        if (isset($_FILES['paymentproof']) && $_FILES['paymentproof']['error'] === UPLOAD_ERR_OK) {  
                $SavePath = "../paymentproofs/";
                $File = $SavePath . basename($_FILES['paymentproof']["name"]);
                $FileType = strtolower(pathinfo($File, PATHINFO_EXTENSION));
        
                if(move_uploaded_file($_FILES['paymentproof']["tmp_name"], $File)){ //uploading the image
        
                    //changing the name of the image
                    //filename: enrollmentID-attachment.ext (ex. 34-attachment1.jpeg)
                    $NewFileName = $SavePath.$enrollmentID."-paymentproof.".$FileType;
                    rename($File, $NewFileName);
        
                    $Query = "INSERT INTO paymentrecord (enrollmentID, paymentModeID, amount, proofimgurl, paymentremarks, paymentdate, paymentterm) 
                    values ('$enrollmentID','$paymentmode','$amount','$NewFileName','$paymentremarks', '$currentdate','$paymentterm')";
                    if($conn->query($Query)) {
                        $transactionID = $conn->insert_id;
                        
                        //check for second payment mode
                        if (isset($_POST['secondpaymentcheck'])) {
                            processSecondPayment($conn, $amount, $transactionID, $enrollmentID);
                        }
                        else {
                            $_SESSION['action-success'] = "Payment request has been sent.";
                            header("Location: ../student/admission.php");
                            exit();
                        }
                    }
                    else {
                        $_SESSION['action-error'] = "An error occured on payment request.";
                        header("Location: ../student/balancesettlement.php?enrollmentID=".$enrollmentID);
                        exit();
                    }
                }   
                else {
                    $_SESSION['action-error'] = "An error occured on payment request.";
                        header("Location: ../student/balancesettlement.php?enrollmentID=".$enrollmentID);
                        exit();
                }
        }
        else {
            $_SESSION['action-error'] = "Payment proof is required";
            header("Location: ../student/balancesettlement.php?enrollmentID=".$enrollmentID);
            exit();
        }
    }
    else {
        $Query = "INSERT INTO paymentrecord (enrollmentID, paymentModeID, amount, paymentremarks, paymentdate, paymentterm) 
        values ('$enrollmentID','$paymentmode','$amount','$paymentremarks','$currentdate','$paymentterm')";
        if($conn->query($Query)) {
            $_SESSION['action-success'] = "Payment request has been sent.";
            header("Location: ../student/admission.php");
            exit();
        }
        else {
            $_SESSION['action-error'] = "An error occured on payment request.";
            header("Location: ../student/balancesettlement.php?enrollmentID=".$enrollmentID);
            exit();
        }
    }



function processSecondPayment($conn, $firstpaymentamount, $transactionID, $enrollmentID) {
    $paymentmode2 = $_POST['paymentmode2'];
    $paymenttype2 = $_POST['paymenttype2'];
    $amount2 = $_POST['amount2'];
    $paymentremarks2 = (isset($_POST['paymentremarks2'])) ? $_POST['paymentremarks2'] : "";
    $totalpaymentamount = $firstpaymentamount + $amount2;


    if ($paymenttype2 == "Online") {
        if (isset($_FILES['paymentproof2']) && $_FILES['paymentproof2']['error'] === UPLOAD_ERR_OK) {  
                $SavePath = "../paymentproofs/";
                $File = $SavePath . basename($_FILES['paymentproof2']["name"]);
                $FileType = strtolower(pathinfo($File, PATHINFO_EXTENSION));
        
                if(move_uploaded_file($_FILES['paymentproof2']["tmp_name"], $File)){ //uploading the image
        
                    //changing the name of the image
                    //filename: enrollmentID-attachment.ext (ex. 34-attachment1.jpeg)
                    $NewFileName2 = $SavePath.$enrollmentID."-paymentproof2.".$FileType;
                    rename($File, $NewFileName);

                    mysqli_query($conn,"UPDATE paymentrecord SET secondPaymentModeID = '$paymentmode2', secondamount = '$amount2', secondproofimgurl = '$NewFileName2', secondpaymentremarks = '$paymentremarks2', totalpaymentamount = '$totalpaymentamount' WHERE transactionID = '$transactionID'");

                    $_SESSION['action-success'] = "Payment request has been sent.";
                    header("Location: ../student/admission.php");
                    exit();
                    
                    
                }   
                else {
                    $_SESSION['action-error'] = "An error occured on payment request.";
                        header("Location: ../student/balancesettlement.php?enrollmentID=".$enrollmentID);
                        exit();
                }
        }
        else {
            $_SESSION['action-error'] = "Second payment proof is required";
            header("Location: ../student/balancesettlement.php?enrollmentID=".$enrollmentID);
            exit();
        }
    }
    else {
        //update paymentrecord
        mysqli_query($conn,"UPDATE paymentrecord SET secondPaymentModeID = '$paymentmode2', secondamount = '$amount2', secondpaymentremarks = '$paymentremarks2', totalpaymentamount = '$totalpaymentamount' WHERE transactionID = '$transactionID'");
        $_SESSION['action-success'] = "Payment request has been sent.";
        header("Location: ../student/admission.php");
        exit();
    }


    //update paymentrecord
    //mysqli_query($conn,"UPDATE paymentrecords SET  WHERE transactionID = '$transactionID'");
}

?>