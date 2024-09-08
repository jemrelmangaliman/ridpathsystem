<?php
session_start();
$conn = require '../config/config.php';

    $ID = $_POST['v-paymentmodeID'];
    $paymentmodename = mysqli_real_escape_string($conn, $_POST['v-paymentmodename']);
    $paymenttype = $_POST['v-paymenttype'];
    $status = $_POST['v-isactive'];

    //directory for saving image file
    $ImageSavePath = "../payment-qr/";
    $ImageFile = $ImageSavePath . basename($_FILES["v-qrimage"]["name"]);
    $ImageFileType = strtolower(pathinfo($ImageFile, PATHINFO_EXTENSION));

    $currentPaymentDetails = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM paymentmodes WHERE paymentModeID = '$ID'"));
    $currentpaymenttype = $currentPaymentDetails['paymenttype'];
    $currentqrimgurl = $currentPaymentDetails['qrimgurl'];

    if($paymenttype == "Online") {
        if ($_FILES["v-qrimage"]["size"] > 1000000) {
            $_SESSION['action-error'] = "Image file should be less than 1MB.";
            header('location: ../admin/paymentmodes.php');
            exit();
        }

        // Check the image file extensions
        if($ImageFileType != "jpg" && $ImageFileType != "png" && $ImageFileType != "jpeg") {
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

        if(move_uploaded_file($_FILES["v-qrimage"]["tmp_name"], $ImageFile)){ //uploading the image

            //changing the name of the image
            $NewImageName = $ImageSavePath.$paymentmodename.".".$ImageFileType;
            rename($ImageFile, $NewImageName);

            $Query = "UPDATE paymentmodes SET description='$paymentmodename', paymenttype='$paymenttype', qrimgurl='$NewImageName', isactive='$status' WHERE paymentModeID = '$ID'";
        }
        else {
            $_SESSION['action-error'] = "An error occurred in uploading the QR code.";
            header("Location: ../admin/paymentmodes.php");
            exit();
        }
    }
    else {
        //delete old qr file if existing
        if ($currentpaymenttype == "Online") {
            if (file_exists($currentqrimgurl)) {
                unlink($currentqrimgurl);
            }
        }

        $Query = "UPDATE paymentmodes SET description='$paymentmodename', paymenttype='$paymenttype', qrimgurl='', isactive='$status' WHERE paymentModeID = '$ID'";
    }

   
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