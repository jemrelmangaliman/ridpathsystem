<?php 
$conn = require '../config/config.php';

$description = $_REQUEST['description'];
$fetchData = mysqli_query($conn, "SELECT * FROM interests IR 
LEFT JOIN strands ST ON IR.strandID = ST.strandID WHERE IR.description='$description'");
$strandstext = '';

if (mysqli_num_rows($fetchData) != 0) {
   while ($Data = mysqli_fetch_assoc($fetchData)) {
    $strandname = $Data['strandname'];
    $strandstext .= '<p><span class="fw-bold text-success">'.$strandname.'</p>';   
   }
}
else {
    $strandstext = '<p><span class="fw-bold text-success">None </span></p>';
}

echo $strandstext;
?>