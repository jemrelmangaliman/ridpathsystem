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
        
                    $Query = "INSERT INTO paymentrecord (enrollmentID, paymentModeID, amount, proofimgurl, paymentremarks) 
                    values ('$enrollmentID','$paymentmode','$amount','$NewFileName','$paymentremarks')";
                    if($conn->query($Query)) {
                        $transactionID = $conn->insert_id;
                        //update enrollmentrecord
                        mysqli_query($conn,"UPDATE enrollmentrecords SET transactionID = '$transactionID' WHERE enrollmentID = '$enrollmentID'");

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
        $Query = "INSERT INTO paymentrecord (enrollmentID, paymentModeID, amount, paymentremarks) 
        values ('$enrollmentID','$paymentmode','$amount','$paymentremarks')";
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


?>