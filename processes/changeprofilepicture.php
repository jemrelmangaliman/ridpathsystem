<?php
session_start();
$conn = require '../config/config.php';

    $userID = $_SESSION['user_id'];
    $returnpage = $_POST['returnpage'];
    //directory for saving image file
    $SavePath = "../userimages/";
    $File = $SavePath . basename($_FILES["image"]["name"]);
    $FileType = strtolower(pathinfo($File, PATHINFO_EXTENSION));

        if ($returnpage == "student") {
            //check if there is an existing profile picture
            $DataArray = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM students WHERE tempID= '$userID'"));
        }
        else {
            //check if there is an existing profile picture
            $DataArray = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE userID= '$userID'"));
        }
  
        if ($DataArray['profileimgurl'] != null && file_exists($DataArray['profileimgurl'])) {
            unlink($DataArray['profileimgurl']);
        }

        if ($_FILES["image"]["size"] > 1000000) {
            $_SESSION['action-error'] = "Image file should be less than 1MB.";
            header('location: ../'.$returnpage.'/profile.php');
            exit();
        }

        // Check the image file extensions
        if($FileType != "jpg" && $FileType != "png" && $FileType != "jpeg") {
            $_SESSION['action-error'] = "The allowed image types are JPG/JPEG and PNG only.";
            header('location: ../'.$returnpage.'/profile.php');
            exit();
        }

        if(move_uploaded_file($_FILES["image"]["tmp_name"], $File)){ //uploading the image

            if ($returnpage == "student") {
                //changing the name of the image
                $NewFileName = $SavePath.'s'.$userID.".".$FileType;
                rename($File, $NewFileName);
                $Query = "UPDATE students SET profileimgurl = '$NewFileName' WHERE tempID = '$userID'";
            }
            else if ($returnpage == "registrar") {
                //changing the name of the image
                $NewFileName = $SavePath.'r'.$userID.".".$FileType;
                rename($File, $NewFileName);
                $Query = "UPDATE users SET profileimgurl = '$NewFileName' WHERE userID = '$userID'";
            }
            else if ($returnpage == "admin") {
                //changing the name of the image
                $NewFileName = $SavePath.'a'.$userID.".".$FileType;
                rename($File, $NewFileName);
                $Query = "UPDATE users SET profileimgurl = '$NewFileName' WHERE userID = '$userID'";
            }

        }
        else {
            $_SESSION['action-error'] = "An error occurred in uploading the image.";
            header('location: ../'.$returnpage.'/profile.php');
            exit();
        }
   
   
    if (mysqli_query($conn, $Query)) {
            $_SESSION['action-success'] = "Profile picture updated.";
            header('location: ../'.$returnpage.'/profile.php');
            exit();
        }
        else {
            $_SESSION['action-error'] = "An error occurred.";
            header('location: ../'.$returnpage.'/profile.php');
            exit();
        }

?>