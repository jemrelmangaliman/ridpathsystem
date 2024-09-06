<?php
session_start();
$conn = require '../config/config.php';

    $ID = $_POST['miscID'];
    $amount = $_POST['amount'];
    $strand = $_POST['strand'];
   
            $Query = "UPDATE miscellaneousfees SET amount='$amount', strandID='$strand' WHERE miscID = '$ID'";

            if (mysqli_query($conn, $Query)) {
                $_SESSION['action-success'] = "Miscellaneous fee updated.";
                header("Location: ../admin/miscellaneousfees.php");
                exit();
            }
            else {
                $_SESSION['action-error'] = "An error occurred.";
                header("Location: ../admin/miscellaneousfees.php");
                exit();
            }
    

    

?>