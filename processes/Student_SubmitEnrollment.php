<?php
session_start();
$conn = require '../config/config.php';

$studentid = $_SESSION['user_id'];
$strandID = $_POST['strand'];
$enrollmentstatusID = 1;
$interest = $_POST['interest'];

$attachmentlist = ['attachment1','attachment2','attachment13','attachment4','attachment5','attachment6','attachment7'];





function processsAttachmentFiles() {

}

?>