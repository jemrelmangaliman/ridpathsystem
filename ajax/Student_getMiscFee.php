<?php 
$conn = require '../config/config.php';

$strandID = $_REQUEST['ID'];
$fetchData = mysqli_query($conn, "SELECT * FROM miscellaneousfees WHERE strandID='$strandID'");
$miscfeetext = '';

if (mysqli_num_rows($fetchData) != 0) {
   while ($Data = mysqli_fetch_assoc($fetchData)) {
    $amount = $Data['amount'];
    $description = $Data['description'];
    $miscfeetext .= '<small> ₱'.$amount.' - '.$description.'</small><br>';   
   }
}
else {
    $miscfeetext = '<small>₱0.00</small>';
}

echo $miscfeetext;
?>