<?php 
$conn = require '../config/config.php';

$ID = $_REQUEST['ID'];
$fetchData = mysqli_query($conn, "SELECT * FROM paymentmodes WHERE paymentModeID='$ID'");
$DataArray = mysqli_fetch_assoc($fetchData);

echo $DataArray['qrimgurl'];
?>