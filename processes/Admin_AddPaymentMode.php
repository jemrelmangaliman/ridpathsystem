<?php
session_start();
$conn = require '../config/config.php';

    $paymentmodename = mysqli_real_escape_string($conn, $_POST['paymentmodename']);
    $paymenttype = $_POST['paymenttype'];
    $status = $_POST['isactive'];
    $accountnumber = "";
    //directory for saving image file
    $SavePath = "../payment-qr/";
    $File = $SavePath . basename($_FILES["qrimage"]["name"]);
    $FileType = strtolower(pathinfo($File, PATHINFO_EXTENSION));

    if($paymenttype == "Online") {
        //set the account number variable value
        $accountnumber = $_POST['accountnumber'];

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

        if(move_uploaded_file($_FILES["qrimage"]["tmp_name"], $File)){ //uploading the image

            //changing the name of the image
            $NewFileName = $SavePath.$paymentmodename.".".$FileType;
            rename($File, $NewFileName);

            $Query = "INSERT INTO paymentmodes (description, paymenttype, qrimgurl, accountnumber, isactive) values ('$paymentmodename','$paymenttype','$NewFileName','$accountnumber','$status')";
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