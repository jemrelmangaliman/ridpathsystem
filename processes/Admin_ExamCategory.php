<?php
session_start();
$conn = require '../config/config.php';

if (isset($_POST['AddExamCategory'])) {
    $categoryname = $_POST['categoryname'];

    $Query = "INSERT INTO examcategory (categoryname) VALUES ('$categoryname')";

    if (mysqli_query($conn, $Query)) {
            $_SESSION['action-success'] = "Exam category added.";
            header("Location: ../admin/examcategory.php");
            exit();
        }
        else {
            $_SESSION['action-error'] = "An error occurred.";
            header("Location: ../admin/examcategory.php");
            exit();
        }
}
if (isset($_POST['EditExamCategory'])) {
    $categoryname = $_POST['categoryname'];
    $ID = $_POST['ID'];
    $Query = "UPDATE examcategory SET categoryname='$categoryname' WHERE examCategoryID = '$ID'";

    if (mysqli_query($conn, $Query)) {
            $_SESSION['action-success'] = "Exam category updated.";
            header("Location: ../admin/examcategory.php");
            exit();
        }
        else {
            $_SESSION['action-error'] = "An error occurred.";
            header("Location: ../admin/examcategory.php");
            exit();
        }
}
   

?>