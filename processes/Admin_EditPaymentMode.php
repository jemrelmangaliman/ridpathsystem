<?php
session_start();
$conn = require '../config/config.php';

    $ID = $_POST['v-paymentmodeID'];
    $paymentmodename = mysqli_real_escape_string($conn, $_POST['v-paymentmodename']);
    $paymenttype = $_POST['v-paymenttype'];
    $status = $_POST['v-isactive'];
    $accountnumber = "";

    //directory for saving image file
    $SavePath = "../payment-qr/";
    $File = $SavePath . basename($_FILES["v-qrimage"]["name"]);
    $FileType = strtolower(pathinfo($File, PATHINFO_EXTENSION));


    $currentPaymentDetails = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM paymentmodes WHERE paymentModeID = '$ID'"));
    $currentpaymenttype = $currentPaymentDetails['paymenttype'];
    $currentqrimgurl = $currentPaymentDetails['qrimgurl'];

    if($paymenttype == "Online") {
        //set the account number variable value
        $accountnumber = $_POST['v-accountnumber'];
        
        if ($accountnumber == 0) {
            $_SESSION['action-error'] = "Invalid account number value.";
            header('location: ../admin/paymentmodes.php');
            exit();
        }

        //check if an image is uploaded
        if (isset($_FILES["v-qrimage"]) && $_FILES["v-qrimage"]["error"] === UPLOAD_ERR_OK) { 
            if ($_FILES["qrimage"]["size"] > 1000000) {
                $_SESSION['action-error'] = "Image file should be less than 1MB.";
                header('location: ../admin/paymentmodes.php');
                exit();
            }

            // Check the image file extensions
            if($FileType != "jpg" && $FileType != "png" && $FileType != "jpeg") {
                $_SESSION['action-error'] = "The allowed image types are JPG/JPEG and PNG only.";
                header('location: ../admin/paymentmodes.php');
                exit();
            }
    
            //delete old qr file if existing
            if ($currentpaymenttype == "Online") {
                if (file_exists($currentqrimgurl)) {
                    unlink($currentqrimgurl);
                }
            }
    
            //delete old qr file if existing
            if (file_exists($currentqrimgurl)) {
                unlink($currentqrimgurl);
            }

            //upload the new qr image files
            if(move_uploaded_file($_FILES["v-qrimage"]["tmp_name"], $File)){ //uploading the image

                //changing the name of the image
                $NewFileName = $SavePath.$paymentmodename.".".$FileType;
                rename($File, $NewFileName);
    
                $Query = "UPDATE paymentmodes SET description='$paymentmodename', paymenttype='$paymenttype', qrimgurl='$NewFileName', accountnumber='$accountnumber', isactive='$status' WHERE paymentModeID = '$ID'";
            }
            else {
                $_SESSION['action-error'] = "An error occurred in uploading the QR code.";
                header("Location: ../admin/paymentmodes.php");
                exit();
            }
            
        }
        else {
            $Query = "UPDATE paymentmodes SET description='$paymentmodename', paymenttype='$paymenttype', accountnumber='$accountnumber', isactive='$status' WHERE paymentModeID = '$ID'";
        }
    }
    else {
        //delete old qr file if existing
        if ($currentpaymenttype == "Online") {
            if (file_exists($currentqrimgurl)) {
                unlink($currentqrimgurl);
            }
        }

        $Query = "UPDATE paymentmodes SET description='$paymentmodename', paymenttype='$paymenttype', qrimgurl='', accountnumber = '', isactive='$status' WHERE paymentModeID = '$ID'";
    }

   

    //execute the query
    if (mysqli_query($conn, $Query)) {
            $_SESSION['action-success'] = "Payment mode updated.";
            header("Location: ../admin/paymentmodes.php");
            exit();
        }
        else {
            $_SESSION['action-error'] = "An error occurred.";
            header("Location: ../admin/paymentmodes.php");
            exit();
        }

?>