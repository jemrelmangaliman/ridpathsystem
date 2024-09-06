<?php
session_start();
$conn = require '../config/config.php';

    $amount = $_POST['amount'];
    $strand = $_POST['strand'];
    $description = $_POST['description'];

   
            $Query = "INSERT INTO miscellaneousfees (amount, description, strandID) values ('$amount','$description','$strand')";

            if (mysqli_query($conn, $Query)) {
                $_SESSION['action-success'] = "Miscellaneous fee added.";
                header("Location: ../admin/miscellaneousfees.php");
                exit();
            }
            else {
                $_SESSION['action-error'] = "An error occurred.";
                header("Location: ../admin/miscellaneousfees.php");
                exit();
            }
    


    

?>