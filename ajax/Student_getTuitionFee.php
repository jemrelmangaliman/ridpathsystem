<?php 
$conn = require '../config/config.php';

$strandID = $_REQUEST['ID'];
$fetchData = mysqli_query($conn, "SELECT * FROM tuitionfees WHERE strandID='$strandID'");
$DataArray = mysqli_fetch_assoc($fetchData);

if (mysqli_num_rows($fetchData) != 0) {
    $amount = $DataArray['amount'].'.00';
}
else {
    $amount = '0.00';
}

echo $amount;
?>