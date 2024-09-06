<?php
session_start();
$conn = require '../config/config.php';

    $amount = $_POST['amount'];
    $strand = $_POST['strand'];

    $ExistCheckQuery = mysqli_query($conn,"SELECT * FROM tuitionfees WHERE strandID = '$strand'");

    if(mysqli_num_rows($ExistCheckQuery) == 1) {
            $_SESSION['action-error'] = "A tuition fee amount is already registered for this strand.";
            header("Location: ../admin/tuitionfees.php");
            exit();
    }
    else {
            $Query = "INSERT INTO tuitionfees (amount, strandID) values ('$amount','$strand')";

            if (mysqli_query($conn, $Query)) {
                $_SESSION['action-success'] = "Tuition fee added.";
                header("Location: ../admin/tuitionfees.php");
                exit();
            }
            else {
                $_SESSION['action-error'] = "An error occurred.";
                header("Location: ../admin/tuitionfees.php");
                exit();
            }
    }


    

?>