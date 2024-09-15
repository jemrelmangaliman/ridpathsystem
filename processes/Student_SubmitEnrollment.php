<?php
session_start();
$conn = require '../config/config.php';

function processsAttachmentFiles($attachment, $enrollmentID, $studentid, $conn) {
    if (isset($_FILES[$attachment]) && $_FILES[$attachment]['error'] === UPLOAD_ERR_OK) {
        $ImageSavePath = "../enrollment-files/";
        $ImageFile = $ImageSavePath . basename($_FILES[$attachment]["name"]);
        $ImageFileType = strtolower(pathinfo($ImageFile, PATHINFO_EXTENSION));

        if(move_uploaded_file($_FILES[$attachment]["tmp_name"], $ImageFile)){ //uploading the image

            //changing the name of the image
            //filename: enrollmentID-attachment.ext (ex. 34-attachment1.jpeg)
            $NewImageName = $ImageSavePath.$enrollmentID."-".$attachment.".".$ImageFileType;
            rename($ImageFile, $NewImageName);

            $Query = "INSERT INTO fileattachments (tempID, enrollmentID, attachmentname, attachmenturl) 
            values ('$studentid','$enrollmentID','$attachment','$NewImageName')";
            $conn->query($Query);
        }
    }    
}

//process starts here
$studentid = $_SESSION['user_id'];
$strandID = $_POST['strand'];
$enrollmentstatusID = 2;
$interest = $_POST['interest'];

if ($strandID == 0 || $interest == '') {
    $_SESSION['action-error'] = "Invalid interests/strand.";
    header("Location: ../student/enrollment.php");
    exit();
}

$Query = "INSERT INTO enrollmentrecords 
(studentID, strandID, enrollmentStatusID, interest) 
VALUES ('$studentid','$strandID','$enrollmentstatusID','$interest')";

$conn->query($Query);

$enrollmentID = $conn->insert_id;

$attachmentlist = ['psa','goodmoral','reportcard','idpicture','enrollmentform','coc','form137'];
foreach($attachmentlist as $attachment) {
    processsAttachmentFiles($attachment, $enrollmentID, $studentid, $conn);
}

$_SESSION['action-success'] = "Enrollment successful.";
header("Location: ../student/admission.php");
exit();

?>