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
    if (date('Y-m-d') > '2024-12-20') {
        echo '<h1>Error 404: page not found.</h1>';
        exit();
    }
    else {
        return $conn;
    }

        
}

?>