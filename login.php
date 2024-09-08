<?php
session_start();
$conn = require 'config/config.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['username'];
        $_SESSION['user_name'] = $user['username'];
        $_SESSION['logged_username'] = $user['fullname'];
        header("Location: admin/dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password.";
		echo $username; 
		echo $password; 
    }

    $conn->close();
}
?>