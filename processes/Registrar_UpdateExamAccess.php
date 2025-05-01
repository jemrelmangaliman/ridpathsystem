<?php
session_start();
$conn = require '../config/config.php';


    if (isset($_POST['examaccessstatus'])) {
        $Query = "UPDATE examaccess SET accessstatus = 1";
    }
    else {
        $Query = "UPDATE examaccess SET accessstatus = 0";
    }

    if (mysqli_query($conn, $Query)) {
            $_SESSION['action-success'] = "Exam access updated";
            header("Location: ../registrar/examaccess.php");
            exit();
    }
    else {
            $_SESSION['action-error'] = "An error occurred.";
            header("Location: ../registrar/examaccess.php");
            exit();
    }

?>