<?php 
$conn = require '../config/config.php';

$strandID = $_REQUEST['ID'];
$totalamount = 0;
$tuitionamount = 0;
$fetchData = mysqli_query($conn, "SELECT * FROM miscellaneousfees WHERE strandID='$strandID'");
$TuitionDetails = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tuitionfees WHERE strandID='$strandID'"));
if (isset($TuitionDetails['amount'])) {
    $tuitionamount = $TuitionDetails['amount'];
}



//add the tution fee to total amount
$totalamount += $tuitionamount;

//add the miscellaneous fees
while ($Data = mysqli_fetch_assoc($fetchData)) {
    $totalamount += $Data['amount'];   
}


echo $totalamount.'.00';
?>