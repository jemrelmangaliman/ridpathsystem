<?php
session_start();
$conn = require '../config/config.php';

if (isset($_POST['EditStudentDetails'])) {

    $ID = $_POST['ID'];
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $email = $_POST['email'];
    $contactnumber = $_POST['contactnumber'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $address= $_POST['address'];
    $studentnumber = trim($_POST['studentnumber']);

    $Query = "UPDATE students SET lastname='$lastname', firstname='$firstname', middlename='$middlename', email='$email', studentnumber='$studentnumber', contactnumber='$contactnumber', gender='$gender', birthday='$birthday', address='$address' WHERE tempID='$ID'";

    if (mysqli_query($conn, $Query)) {
            $_SESSION['action-success'] = "Student records has been updated";
            header("Location: ../admin/studentrecords.php");
            exit();
        }
        else {
            $_SESSION['action-error'] = "An error occurred in updating the student record";
            header("Location: ../admin/studentrecords.php");;
            exit();
        }

}
else if (isset($_POST['EditStudentPassword'])) {
    $ID = $_POST['ID'];
    $password = $_POST['password'];

    $Query = "UPDATE users SET password='$password' WHERE tempID='$userID'";

    if (mysqli_query($conn, $Query)) {
        $_SESSION['action-success'] = "Student password has been updated";
        header("Location: ../admin/studentrecords.php");
        exit();
    }
    else {
        $_SESSION['action-error'] = "An error occurred in updating the student password";
        header("Location: ../admin/studentrecords.php");;
        exit();
    }
       
}

?>