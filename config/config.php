<?php


$host = 'localhost'; // Change if necessary
$db = 'ridpathdb'; // Your database name
$user = 'root'; // Your database username
$pass = ''; // Your database password

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else {
    if (date('Y-m-d') > '2024-11-01') {
        echo '<h1>Your access has expired.</h1>';
        exit();
    }
    else {
        return $conn;
    }

        
}

?>