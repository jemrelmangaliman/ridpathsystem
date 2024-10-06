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
                $_SESSION['action-success'] = "Password Updated on ".$currentDateTime;
                header("Location: ../admin/profile_changepassword.php");
                exit();
            }
            else {
                $_SESSION['action-error'] = "An error occurred on ".$currentDateTime;
                header("Location: ../admin/profile_changepassword.php");
                exit();
            }
        }
        else
        {
            $_SESSION['action-error'] = "New Password and Confirm New Password does not Match! on ".$currentDateTime;
            header("Location: ../admin/profile_changepassword.php");
        }
    }
    else
    {
        $_SESSION['action-error'] = "Current Password Incorrect! on ".$currentDateTime;
        header("Location: ../admin/profile_changepassword.php");
    }
?>