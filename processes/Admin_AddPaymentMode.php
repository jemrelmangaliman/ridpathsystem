<?php
session_start();
$conn = require '../config/config.php';

    $paymentmodename = mysqli_real_escape_string($conn, $_POST['paymentmodename']);
    $paymenttype = $_POST['paymenttype'];
    $status = $_POST['isactive'];
    //directory for saving image file
    $ImageSavePath = "../payment-qr/";
    $ImageFile = $ImageSavePath . basename($_FILES["qrimage"]["name"]);
    $ImageFileType = strtolower(pathinfo($ImageFile, PATHINFO_EXTENSION));

    if($paymenttype == "Online") {
        if ($_FILES["qrimage"]["size"] > 1000000) {
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

        if(move_uploaded_file($_FILES["qrimage"]["tmp_name"], $ImageFile)){ //uploading the image

            //changing the name of the image
            $NewImageName = $ImageSavePath.$paymentmodename.".".$ImageFileType;
            rename($ImageFile, $NewImageName);

            $Query = "INSERT INTO paymentmodes (description, paymenttype, qrimgurl, isactive) values ('$paymentmodename','$paymenttype','$NewImageName','$status')";
        }
        else {
            $_SESSION['action-error'] = "An error occurred in uploading the QR code.";
            header("Location: ../admin/paymentmodes.php");
            exit();
        }
    }
    else {
        $Query = "INSERT INTO paymentmodes (description, paymenttype, isactive) values ('$paymentmodename','$paymenttype','$status')";
    }

   
    if (mysqli_query($conn, $Query)) {
            $_SESSION['action-success'] = "Payment mode added.";
            header("Location: ../admin/paymentmodes.php");
            exit();
        }
        else {
            $_SESSION['action-error'] = "An error occurred.";
            header("Location: ../admin/paymentmodes.php");
            exit();
        }

?>