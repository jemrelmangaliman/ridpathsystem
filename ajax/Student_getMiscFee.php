<?php 
$conn = require '../config/config.php';

$strandID = $_REQUEST['ID'];
$fetchData = mysqli_query($conn, "SELECT * FROM miscellaneousfees WHERE strandID='$strandID'");
$miscfeetext = '';

if (mysqli_num_rows($fetchData) != 0) {
   while ($Data = mysqli_fetch_assoc($fetchData)) {
    $amount = $Data['amount'];
    $description = $Data['description'];
    $miscfeetext .= '<p><span class="fw-bold">• ₱'.$amount.' </span>('.$description.')</p>';   
   }
}
else {
    $miscfeetext = '<p><span class="fw-bold">₱0.00 </span></p>';
}

echo $miscfeetext;
?>