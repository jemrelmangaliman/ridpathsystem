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
$strandID = $_POST['strand'];
$enrollmentstatusID = 2;
$interest = $_POST['interest'];
$studentTypeID = $_POST['studenttype'];
$gradelevel = $_POST['gradelevel'];

if ($strandID == 0 || $interest == '') {
    $_SESSION['action-error'] = "Invalid interests/strand.";
    header("Location: ../student/enrollment.php");
    exit();
}

//get current active schoolyear
$SchooYearDetails = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM schoolyear WHERE isactive= 'Yes'"));
$schoolYearID = $SchooYearDetails['schoolYearID'];

$Query = "INSERT INTO enrollmentrecords 
(studentID, strandID, enrollmentStatusID, interest, studentTypeID, gradelevel, schoolYearID) 
VALUES ('$studentid','$strandID','$enrollmentstatusID','$interest', '$studentTypeID','$gradelevel','$schoolYearID')";

$conn->query($Query);

$enrollmentID = $conn->insert_id;

$attachmentlist = ['psa','goodmoral','reportcard','idpicture','enrollmentform','coc'];
foreach($attachmentlist as $attachment) {
    processsAttachmentFiles($attachment, $enrollmentID, $studentid, $conn);
}

$_SESSION['action-success'] = "Enrollment successful.";
header("Location: ../student/admission.php");
exit();

?>