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
            $Query = "UPDATE users SET password='$newPassword' WHERE userID='$userID'";

            if (mysqli_query($conn, $Query)) {
                $_SESSION['action-success-changepassword'] = "Notification: Password Updated on ".$currentDateTime;
                $_SESSION['action-error-changepassword'] = "";
                header("Location: ../admin/profile_changepassword.php");
                exit();
            }
            else {
                $_SESSION['action-error-changepassword'] = "Warning: An error occurred on ".$currentDateTime;
                $_SESSION['action-success-changepassword'] = "";
                header("Location: ../admin/profile_changepassword.php");
                exit();
            }
        }
        else
        {
            $_SESSION['action-error-changepassword'] = "Warning: New Password and Confirm New Password does not Match! on ".$currentDateTime;
            $_SESSION['action-success-changepassword'] = "";
            header("Location: ../admin/profile_changepassword.php");
        }
    }
    else
    {
        $_SESSION['action-error-changepassword'] = "Warning: Current Password Incorrect! on ".$currentDateTime;
        $_SESSION['action-success-changepassword'] = "";
        header("Location: ../admin/profile_changepassword.php");
    }
?>