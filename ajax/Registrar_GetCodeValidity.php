<?php 
$conn = require '../config/config.php';

$code = $_REQUEST['code'];
$email = $_REQUEST['email'];

$fetchData = mysqli_query($conn, "SELECT * FROM registrationcodes WHERE code ='$code' AND owneremail = '$email'");
$CodeData = mysqli_fetch_assoc($fetchData);

if (mysqli_num_rows($fetchData) == 0) {
    echo 'No';
}
else if ($CodeData['used'] == "Yes") {
    echo 'Used';
}
else {
    echo 'Yes';
}
?>