<?php 
$conn = require '../config/config.php';

$enrollmentID = $_REQUEST['ID'];
$fetchQuery = "SELECT * FROM enrollmentrecords ER 
LEFT JOIN  students ST ON ST.tempID = ER.studentID
LEFT JOIN enrollmentstatus ES ON ER.enrollmentStatusID = ES.statusID
LEFT JOIN strands SD ON SD.strandID = ER.strandID
LEFT JOIN tuitionfees TF ON TF.strandID = SD.strandID
WHERE ER.enrollmentID = '$enrollmentID'";
$fetchedData = mysqli_query($conn, $fetchQuery);
$DataArray = mysqli_fetch_assoc($fetchedData);
$firstname = $DataArray['firstname'];
$middlename = $DataArray['middlename'];
$lastname = $DataArray['lastname'];
$email = $DataArray['email'];
$contactnumber = $DataArray['contactnumber'];
$strandname = $DataArray['strandname'];
$tuitionfee = $DataArray['amount'];
$enrollmentstatus = $DataArray['statusname'];
$enrollmentstatusID = $DataArray['statusID'];
$strandID = $DataArray['strandID'];
$interest = $DataArray['interest'];
$enrollmentID = $DataArray['enrollmentID'];


//get misc fee total using fetched strand ID in the first query
$MiscFeeData = mysqli_query($conn, "SELECT * FROM miscellaneousfees WHERE strandID='$strandID'");
$totalamount = 0;
$totalamount += $tuitionfee; //add the tuition fee to the total amount
$miscfeetext = '';

if (mysqli_num_rows($MiscFeeData) != 0) {
   while ($Data = mysqli_fetch_assoc($MiscFeeData)) {
    $amount = $Data['amount'];
    $totalamount += $amount; //add the misc fee to the total
    $description = $Data['description'];
    $miscfeetext .= '<p><span class="fw-bold">₱'.$amount.' </span>('.$description.')</p>';   
   }
}
else {
    $miscfeetext = '<p><span class="fw-bold">₱0.00 </span></p>';
}

$ctr = 0;
$attachmenttext = '';
//get current uploaded enrollment attachments
$attachmentlist = ['psa','goodmoral','reportcard','idpicture','enrollmentform','coc','form137'];
$attachmentlabellist = 
['Original Copy of PSA','Certificate of Good Moral Character','Original Report Card','2pcs 2×2 and 1x1 picture (white background)','Duly Accomplished Enrolment Form','Certificate of Completion (grade 10)','Form 137'];                                     
    foreach ($attachmentlist as $attachmentitem) {
        $isfound = 0;
        $attachmentname = '';
        $attachmentlabel = $attachmentlabellist[$ctr];
        $attachmentsData = mysqli_query($conn, "SELECT * FROM fileattachments WHERE enrollmentID='$enrollmentID'");
        
        while ($fetchedAttachments = mysqli_fetch_assoc($attachmentsData)) {
                $attachmentname = $fetchedAttachments['attachmentname'];
                $filename = $fetchedAttachments['filename'];
                $attachmentlink = $fetchedAttachments['attachmenturl'];
                if ($attachmentitem == $attachmentname) {
                    $attachmenttext.= '<div class="row mx-1 mb-3">
                            <div class="col">
                                <small>'.$attachmentlabel.'</small>
                                <div class="input-group">
                                    <i class="bi bi-check-circle-fill text-success mr-2"></i><a href="'.$attachmentlink.'" download="'.$filename.'">'.$filename.'</a>
                                </div>
                            </div>
                        </div>';
                    $isfound = 1;
                    break;
                }  
        } 
        
        //if an attachment is not found, display a file input field instead
        if ($isfound == 0) {
            $attachmenttext.= '<div class="row mx-1 m-0">
                                <div class="col">
                                    <small>'.$attachmentlabel.'</small>
                                    <div class="input-group">
                                        <i class="bi bi-x-circle-fill text-danger mr-2"></i><p>Not yet submitted</p>
                                    </div>
                                </div>
                            </div>';
        }
        $ctr++;
    }

echo '
<div class="row w-100">
                                    <div class="col-8">
                                        <h5>Personal Information</h5>
                                        <div class="container border shadow mb-3">
                                            <div class="row w-100 mx-1 my-2">
                                                <div class="col">
                                                    <small>First Name</small>
                                                    <p class="border-bottom border-dark fw-bold">'.$firstname.'</p>
                                                </div>
                                                <div class="col">
                                                    <small>Middle Name</small>
                                                    <p class="border-bottom border-dark fw-bold">'.$middlename.'</p>
                                                </div>
                                                <div class="col">
                                                    <small>Last Name</small>
                                                    <p class="border-bottom border-dark fw-bold">'.$lastname.'</p>
                                                </div>
                                            </div> 
                                            <div class="row w-100 mx-1 my-2">
                                                <div class="col-4">
                                                    <small>Contact Number</small>
                                                    <p class="border-bottom border-dark fw-bold">'.$contactnumber.'</p>
                                                </div>
                                                <div class="col-4">
                                                    <small>Email Address</small>
                                                    <p class="border-bottom border-dark fw-bold">'.$email.'</p>
                                                </div>
                                            </div>
                                        </div>

                                        <h5>Enrollment Information</h5>
                                        <div class="container border shadow mb-3">
                                            <div class="row w-100 mx-1 my-2">
                                                <div class="col-4">
                                                    <small>Interest</small>
                                                    <p class="border-bottom border-dark fw-bold">'.$interest.'</p>
                                                </div>
                                                <div class="col-8">
                                                    <small>Selected Strand</small>
                                                    <p class="border-bottom border-dark fw-bold">'.$strandname.'</p>
                                                </div>
                                            </div> 
                                        </div>

                                        <h5>Enrollment Costs</h5>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="container border shadow">
                                                    <div class="row mx-1 mt-2">
                                                        <div class="col">
                                                            <small>Miscellaneous Fees</small>
                                                            '.$miscfeetext.'
                                                        </div>
                                                    </div> 
                                                </div> 
                                            </div>
                                            <div class="col-4">
                                                <div class="container border shadow">
                                                    <div class="row mx-1 mt-2">
                                                        <div class="col">
                                                            <small>Tuition Fee</small>
                                                            <p><span class="fw-bold">₱<span id="tuitionfeetext">'.$tuitionfee.'.00</span></p>
                                                        </div>
                                                    </div> 
                                                </div>  
                                            </div>

                                            <div class="col-4">
                                            <div class="container border shadow">
                                                    <div class="row mx-1 mt-2">
                                                        <div class="col">
                                                            <small>Total Enrollment Cost</small>
                                                            <p><span class="fw-bold">₱<span id="totalamounttext">'.$totalamount.'.00</span></p>
                                                        </div>
                                                    </div> 
                                                </div> 
                                            </div>
                                            
                                        </div> 
                                    </div>

                                    <div class="col-4">
                                            <h5>Download Attachments</h5>
                                            <div class="container border shadow pt-3">
                                               '.$attachmenttext.'
                                                
                                            </div> 
                                    </div>
                                </div> 
   ';                    