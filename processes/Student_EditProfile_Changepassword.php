<?php
session_start();
$conn = require '../config/config.php';

    $userID = $_POST['userID'];
    $username = $_POST['username'];
    $currentPassword = $_POST['currentPassword'];
    $currPassword = $_POST['currPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmnewPassword = $_POST['confirmnewPassword'];
    date_default_timezone_set('Asia/Manila');
    $currentDateTime = date('Y-m-d H:i:s');

    if($currentPassword == $currPassword)
    {
        if($newPassword == $confirmnewPassword)
        {
            $Query = "UPDATE students SET password='$newPassword' WHERE tempID='$userID'";

            if (mysqli_query($conn, $Query)) {
                $_SESSION['action-success'] = "Notification: Password Updated on ".$currentDateTime;
                header("Location: ../student/profile_changepassword.php");
                exit();
            }
            else {
                $_SESSION['action-error'] = "Warning: An error occurred on ".$currentDateTime;
                header("Location: ../student/profile_changepassword.php");
                exit();
            }
        }
        else
        {
            $_SESSION['action-error'] = "Warning: New Password and Confirm New Password does not Match! on ".$currentDateTime;
            header("Location: ../student/profile_changepassword.php");
        }
    }
    else
    {
        $_SESSION['action-error'] = "Warning: Current Password Incorrect! on ".$currentDateTime;
        header("Location: ../student/profile_changepassword.php");
    }
?>