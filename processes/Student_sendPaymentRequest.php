<?php
session_start();
$conn = require '../config/config.php';


//process starts here
$studentid = $_SESSION['user_id'];
$enrollmentID = $_POST['enrollmentID'];
$paymentmode = $_POST['paymentmode'];
$paymenttype = $_POST['paymenttype'];
$amount = $_POST['amount'];
$totalamount = $_POST['totalamount'];
$paymentremarks = (isset($_POST['paymentremarks'])) ? $_POST['paymentremarks'] : "";
$paymentterm = $_POST['paymentterm'];
$Query = '';
$currentdate = date('Y-m-d');

$totalpaidamount = 0;
$GetPaymentRecordsQuery = "SELECT * FROM paymentrecord WHERE enrollmentID='$enrollmentID'";
$GetPaymentRecord = mysqli_query($conn, $GetPaymentRecordsQuery);
while ($PaymentDetail = mysqli_fetch_assoc($GetPaymentRecord)) {
    $totalpaidamount += $PaymentDetail['totalpaymentamount'];
}

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

                        $totalpaidamount += $amount; //add the current payment amount to the total paid amount
                        
                        //check for second payment mode
                        if (isset($_POST['secondpaymentcheck'])) {
                            processSecondPayment($conn, $amount, $transactionID, $enrollmentID, $totalamount, $totalpaidamount);
                        }
                        else {
                            mysqli_query($conn,"UPDATE paymentrecord SET totalpaymentamount = '$amount' WHERE transactionID = '$transactionID'");
                            checkFullPaid($conn, $enrollmentID, $totalamount, $totalpaidamount);
                            
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



function processSecondPayment($conn, $firstpaymentamount, $transactionID, $enrollmentID, $totalamount, $totalpaidamount) {
    $paymentmode2 = $_POST['paymentmode2'];
    $paymenttype2 = $_POST['paymenttype2'];
    $amount2 = $_POST['amount2'];
    $paymentremarks2 = (isset($_POST['paymentremarks2'])) ? $_POST['paymentremarks2'] : "";
    $totalpaymentamount = $firstpaymentamount + $amount2;
    $totalpaidamount += $amount2;


    if ($paymenttype2 == "Online") {
        if (isset($_FILES['paymentproof2']) && $_FILES['paymentproof2']['error'] === UPLOAD_ERR_OK) {  
                $SavePath = "../paymentproofs/";
                $File = $SavePath . basename($_FILES['paymentproof2']["name"]);
                $FileType = strtolower(pathinfo($File, PATHINFO_EXTENSION));
        
                if(move_uploaded_file($_FILES['paymentproof2']["tmp_name"], $File)){ //uploading the image
        
                    //changing the name of the image
                    //filename: enrollmentID-attachment.ext (ex. 34-attachment1.jpeg)
                    $NewFileName2 = $SavePath.$enrollmentID."-paymentproof2.".$FileType;
                    rename($File, $NewFileName2);

                    mysqli_query($conn,"UPDATE paymentrecord SET secondPaymentModeID = '$paymentmode2', secondamount = '$amount2', secondproofimgurl = '$NewFileName2', secondpaymentremarks = '$paymentremarks2', totalpaymentamount = '$totalpaymentamount' WHERE transactionID = '$transactionID'");
                    
                    checkFullPaid($conn, $enrollmentID, $totalamount, $totalpaidamount);

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
        checkFullPaid($conn, $enrollmentID, $totalamount, $totalpaidamount);

        //update paymentrecord
        mysqli_query($conn,"UPDATE paymentrecord SET secondPaymentModeID = '$paymentmode2', secondamount = '$amount2', secondpaymentremarks = '$paymentremarks2', totalpaymentamount = '$totalpaymentamount' WHERE transactionID = '$transactionID'");
        $_SESSION['action-success'] = "Payment request has been sent.";
        header("Location: ../student/admission.php");
        exit();
    }


    //update paymentrecord
    //mysqli_query($conn,"UPDATE paymentrecords SET  WHERE transactionID = '$transactionID'");
}

function checkFullPaid ($conn, $enrollmentID, $totalamount, $totalpaidamount) {

    //get enrollment status
    $enrollmentData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM enrollmentrecords WHERE enrollmentID = '$enrollmentID'"));
    $enrollmentStatusID = $enrollmentData['enrollmentStatusID'];

    if ($enrollmentStatusID == 10) {
        if ($totalpaidamount >= $totalamount) {
            mysqli_query($conn,"UPDATE enrollmentrecords SET enrollmentStatusID = 6 WHERE enrollmentID = '$enrollmentID'");             
        }
    }
    
    

}
?>