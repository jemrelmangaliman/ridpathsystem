<?php
session_start();
$conn = require '../config/config.php';

function processsAttachmentFiles($attachment, $enrollmentID, $studentid, $conn) {
    if (isset($_FILES[$attachment]) && $_FILES[$attachment]['error'] === UPLOAD_ERR_OK) {
        $SavePath = "../enrollment-files/";
        $File = $SavePath . basename($_FILES[$attachment]["name"]);
        $FileType = strtolower(pathinfo($File, PATHINFO_EXTENSION));

        if(move_uploaded_file($_FILES[$attachment]["tmp_name"], $File)){ //uploading the image

            //changing the name of the image
            //filename: enrollmentID-attachment.ext (ex. 34-attachment1.jpeg)
            $NewFileName = $SavePath.$enrollmentID."-".$attachment.".".$FileType;
            $BaseFileName = $enrollmentID."-".$attachment.".".$FileType;
            rename($File, $NewFileName);

            $Query = "INSERT INTO fileattachments (tempID, enrollmentID, attachmentname, filename, attachmenturl) 
            values ('$studentid','$enrollmentID','$attachment','$BaseFileName','$NewFileName')";
            $conn->query($Query);
        }
    }    
}

//process starts here
$studentid = $_SESSION['user_id'];
$enrollmentID = $_POST['enrollmentID'];

$attachmentlist = ['psa','goodmoral','reportcard','idpicture','enrollmentform','coc','form137'];
foreach($attachmentlist as $attachment) {
    if (isset($_FILES[$attachment])) {
        processsAttachmentFiles($attachment, $enrollmentID, $studentid, $conn);
    }

}

$_SESSION['action-success'] = "Checklist updated successfully.";
header("Location: ../student/admission.php");
exit();

?>