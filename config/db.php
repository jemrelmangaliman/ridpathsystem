<?php
$conn = mysqli_connect('localhost', 'root', '', 'ridpathdb');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
