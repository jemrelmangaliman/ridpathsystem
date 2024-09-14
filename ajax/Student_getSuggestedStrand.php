<?php 
$conn = require '../config/config.php';

$description = $_REQUEST['description'];
$fetchData = mysqli_query($conn, "SELECT * FROM interests IR 
LEFT JOIN strands ST ON IR.strandID = ST.strandID WHERE IR.description='$description'");
$strandstext = '';

if (mysqli_num_rows($fetchData) != 0) {
   while ($Data = mysqli_fetch_assoc($fetchData)) {
    $strandname = $Data['strandname'];
    $strandstext .= '<small><span class="fw-bold">• '.$strandname.'</small><br>';   
   }
}
else {
    $strandstext = '<small><span class="fw-bold">• None </span></small>';
}

echo $strandstext;
?>