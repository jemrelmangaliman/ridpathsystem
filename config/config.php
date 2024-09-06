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
        return $conn;
}
?>