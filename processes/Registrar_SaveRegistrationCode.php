<?php
session_start();
$conn = require '../config/config.php';
    $code = $_POST['code'];
    $email = $_POST['email'];

    //Check if the code already exists
    $checkCode = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM registrationcodes WHERE code='$code'"));
    if ($checkCode != 0) {
        $_SESSION['action-error'] = "Registration code already exists. Please generate a new one.";
        header("Location: ../registrar/registration.php");
        exit();
    }

    $Query = "INSERT INTO registrationcodes (code, owneremail, used) VALUES ('$code','$email','No')";
    if (mysqli_query($conn, $Query)) {
            $_SESSION['action-success'] = "Registration code is now ready for use.";
            header("Location: ../registrar/registration.php");
            exit();
        }
        else {
            $_SESSION['action-error'] = "An error occurred.";
            header("Location: ../registrar/registration.php");
            exit();
        }

?>