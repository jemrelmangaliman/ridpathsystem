<?php
require '../shared/header_student.php';
$tempid = $_SESSION['user_id'];

$fetchQuery = "SELECT * FROM students ST 
LEFT JOIN enrollmentrecords ER ON ST.tempID = ER.studentID
LEFT JOIN enrollmentstatus ES ON ER.enrollmentStatusID = ES.statusID
LEFT JOIN strands SD ON SD.strandID = ER.strandID
LEFT JOIN tuitionfees TF ON TF.strandID = SD.strandID
LEFT JOIN studenttype SP ON ER.studentTypeID = SP.studentTypeID
WHERE ST.tempID = '$tempid'";
$fetchedData = mysqli_query($conn, $fetchQuery);
$DataArray = mysqli_fetch_assoc($fetchedData);

$firstname = $DataArray['firstname'];
$middlename = $DataArray['middlename'];
$lastname = $DataArray['lastname'];
$email = $DataArray['email'];
$contactnumber = $DataArray['contactnumber'];
$strandname = $DataArray['strandname'];
$tuitionfee = $DataArray['amount'];
$enrollmentstatus = ($DataArray['statusname'] != null) ? $DataArray['statusname'] : "Not Enrolled";
$studenttype = $DataArray['studenttypedescription'];
$enrollmentstatusID = $DataArray['statusID'];
$strandID = $DataArray['strandID'];
$interest = $DataArray['interest'];
$enrollmentID = $DataArray['enrollmentID'];
$gradelevel = $DataArray['gradelevel'];
$gender = $DataArray['gender'];
$birthday = date('M d, Y', strtotime($DataArray['birthday']));
$address = ($DataArray['address'] != null ) ? $DataArray['address']  : 'Not yet defined';
$enrollmentremarks = $DataArray['enrollmentremarks'];

//get payment record of the enrollment record
$getPaymentRecord = mysqli_query($conn, "SELECT * FROM paymentrecord WHERE enrollmentID='$enrollmentID'");

$proceedtopayment = '';
$resubmit = 'disabled';

if ($enrollmentstatusID != 4 || ($enrollmentstatusID == 4 && mysqli_num_rows($getPaymentRecord) == 1)) {
    $proceedtopayment = 'disabled';
}

if ($enrollmentstatusID == 3) {
    $resubmit = '';
}

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
    $miscfeetext .= '<br><small style="font-size: 13px;">₱'.$amount.' - '.$description.'</small>';   
   }
}
else {
    $miscfeetext = '<small style="font-size: 13px;">₱0.00</small>';
}


$fetchEnrollment = "SELECT * FROM enrollmentrecords WHERE studentID = '$tempid'";
$fetchedData2 = mysqli_query($conn, $fetchEnrollment);
$enrollmentcount = mysqli_num_rows($fetchedData2);
$enrollmentstatusdisplay = '';
$hide = '';

//check if there is an active enrollment record
if ($enrollmentcount != 0) {
    $enrollmentstatusdisplay = '';
}
else {
    $enrollmentstatusdisplay = '<p class="text-danger ml-3">You have no active enrollment record yet!</p>';
    $hide = 'style="display: none;"'; //used to hide the page
}

$transactionID = '';
$paymentmode = '';
$amount = '';
$paymentremarks = '';
$showproofbutton = '';
$nopaymentnotif = 'style="display: none;"';
$paymentrecordcontainer = 'style="display: none;"';
//get payment transaction record for the enrollment record
$GetPaymentRecord = mysqli_query($conn, "SELECT * FROM paymentrecord pr
LEFT JOIN paymentmodes pm ON pr.paymentModeID = pm.paymentModeID
WHERE pr.enrollmentID='$enrollmentID'");
if(mysqli_num_rows($GetPaymentRecord) == 1) {
    $PaymentDetails = mysqli_fetch_assoc($GetPaymentRecord);
    $transactionID = $PaymentDetails['transactionID'];
    $accountnumber = $PaymentDetails['accountnumber'];
    $paymenttype = $PaymentDetails['paymenttype'];
    $proofimgurl = $PaymentDetails['proofimgurl'];
    if ($accountnumber != "" && $accountnumber != null) {
        $paymentmode = $PaymentDetails['description'].' - '.$accountnumber.' ('.$PaymentDetails['paymenttype'].')';
    }
    else {
        $paymentmode = $PaymentDetails['description'].' ('.$PaymentDetails['paymenttype'].')';
    }
    $amount = $PaymentDetails['amount'];
    $paymentremarks = $PaymentDetails['paymentremarks'];

    if($paymenttype == "Online") {
        $showproofbutton = '<button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modal-View"
                                    data-bs-proofimgurl="'.$proofimgurl.'" style="font-size: 11px;"><i class="bi bi-eye-fill" id="table-btn-icon"></i> View Payment Proof</button>';
    }
    
    //display the payment details container
    $paymentrecordcontainer = 'style="display: block;"';
}
else {
    //displays the no payment notification
    $nopaymentnotif = 'style="display: block;"';
}

//get current uploaded enrollment attachments
$attachmentlist = ['psa','goodmoral','reportcard','idpicture','enrollmentform','coc','form137'];
$attachmentlabellist = 
['Original Copy of PSA','Certificate of Good Moral Character','Original Report Card','2pcs 2×2 and 1x1 picture (white background)','Duly Accomplished Enrolment Form','Certificate of Completion (grade 10)','Form 137'];
?>

<style>
    .course-hidden {
        display: none;
    }
</style>

<!-- Begin Page Content -->
<div class="container-fluid">

<?php require '../shared/action-message.php'; ?>
<input type="hidden" id="transactionID" value="<?php echo $transactionID; ?>">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Admission</h1>
        
    </div>

    <!-- Content Row -->
    <div class="row">        
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Admission Details</h6>
                    </div>
                    <div class="row">
                        <!-- Card Body -->
                        <div class="card-body">
                            <?php echo $enrollmentstatusdisplay;?>
                                <div class="row w-100 mx-1 bg-white"  <?php echo $hide; ?>> <!-- hides the page when no enrollment record is active-->
                                    <div class="col-8">
                                        <p class="border-bottom fw-bold">Personal Information</p>
                                        <div class="container-fluid mb-1">
                                            <!-- Full Name Display -->
                                            <div class="row w-100" style="margin-top: -5px;">
                                                <div class="col-3">
                                                    <small id="small" class="fw-bold">Full Name</small>
                                                </div>
                                                <div class="col-1">
                                                    <small id="small" class="fw-bold">:</small>
                                                </div>
                                                <div class="col-8">
                                                    <small><?php echo $lastname.', '.$firstname.' '.$middlename; ?></small>
                                                </div>
                                            </div> 
                                            <!-- Birthday Display -->
                                            <div class="row w-100" style="margin-top: -5px;">
                                                <div class="col-3">
                                                    <small id="small" class="fw-bold">Birthday</small>
                                                </div>
                                                <div class="col-1">
                                                    <small id="small" class="fw-bold">:</small>
                                                </div>
                                                <div class="col-8">
                                                <small><?php echo $birthday; ?></small>
                                                </div>
                                            </div>
                                            <!-- Gender Display -->
                                            <div class="row w-100" style="margin-top: -5px;">
                                                <div class="col-3">
                                                    <small id="small" class="fw-bold">Gender</small>
                                                </div>
                                                <div class="col-1">
                                                    <small id="small" class="fw-bold">:</small>
                                                </div>
                                                <div class="col-8">
                                                <small><?php echo $gender; ?></small>
                                                </div>
                                            </div>
                                            <!-- Contact Number Display -->
                                            <div class="row w-100" style="margin-top: -5px;">
                                                <div class="col-3">
                                                    <small id="small" class="fw-bold">Contact Number</small>
                                                </div>
                                                <div class="col-1">
                                                    <small id="small" class="fw-bold">:</small>
                                                </div>
                                                <div class="col-8">
                                                <small><?php echo $contactnumber; ?></small>
                                                </div>
                                            </div> 
                                            <!-- Email Address Display -->
                                            <div class="row w-100" style="margin-top: -5px;">
                                                <div class="col-3">
                                                    <small id="small" class="fw-bold">Email Address</small>
                                                </div>
                                                <div class="col-1">
                                                    <small id="small" class="fw-bold">:</small>
                                                </div>
                                                <div class="col-8">
                                                    <small><?php echo $email; ?></small>
                                                </div>
                                            </div> 
                                            <!-- Home Address Display -->
                                            <div class="row w-100" style="margin-top: -5px;">
                                                <div class="col-3">
                                                    <small id="small" class="fw-bold">Home Address</small>
                                                </div>
                                                <div class="col-1">
                                                    <small id="small" class="fw-bold">:</small>
                                                </div>
                                                <div class="col-8">
                                                <small><?php echo $address; ?></small>
                                                </div>
                                            </div> 
                                        </div>

                                        <p class="border-bottom fw-bold mt-3">Enrollment Information</p>
                                        <div class="container mb-1">
                                            <!-- Enrollment Status Display -->
                                            <div class="row w-100">
                                                <div class="col">
                                                    <span class="badge badge-primary py-0" style="border-radius: 15px;"><p class="fw-bold text-white text-center my-2"><?php echo $enrollmentstatus; ?></p></span>
                                                </div>
                                            </div> 
                                            <!-- Student Type Display -->
                                            <div class="row w-100 mt-1">
                                                <div class="col-3">
                                                    <small id="small" class="fw-bold">Student Type</small>
                                                </div>
                                                <div class="col-1">
                                                    <small id="small" class="fw-bold">:</small>
                                                </div>
                                                <div class="col-8">
                                                    <small><?php echo $studenttype; ?></small>
                                                </div>
                                            </div>  
                                            <!-- Grade Level Display -->
                                            <div class="row w-100" style="margin-top: -5px;">
                                                <div class="col-3">
                                                    <small id="small" class="fw-bold">Grade Level</small>
                                                </div>
                                                <div class="col-1">
                                                    <small id="small" class="fw-bold">:</small>
                                                </div>
                                                <div class="col-8">
                                                    <small><?php echo 'Grade '.$gradelevel; ?></small>
                                                </div>
                                            </div>     
                                            <!-- Interest Display -->
                                            <div class="row w-100" style="margin-top: -5px;">
                                                <div class="col-3">
                                                    <small id="small" class="fw-bold">Interest</small>
                                                </div>
                                                <div class="col-1">
                                                    <small id="small" class="fw-bold">:</small>
                                                </div>
                                                <div class="col-8">
                                                    <small><?php echo $interest; ?></small>
                                                </div>
                                            </div> 
                                            <!-- Strand Display -->
                                            <div class="row w-100" style="margin-top: -5px;">
                                                <div class="col-3">
                                                    <small id="small" class="fw-bold">Chosen Strand</small>
                                                </div>
                                                <div class="col-1">
                                                    <small id="small" class="fw-bold">:</small>
                                                </div>
                                                <div class="col-8">
                                                    <small><?php echo $strandname; ?></small>
                                                </div>
                                            </div>   
                                            <!-- Enrollment Remarks Display -->
                                            <div class="row w-100" style="margin-top: -5px;">
                                                <div class="col-3">
                                                    <small id="small" class="fw-bold">Enrollment Remarks</small>
                                                </div>
                                                <div class="col-1">
                                                    <small id="small" class="fw-bold">:</small>
                                                </div>
                                                <div class="col-8">
                                                    <small class="text-primary"><?php echo $enrollmentremarks; ?></small>
                                                </div>
                                            </div>                          
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col">
                                                <div class="accordion accordion-flush" id="accordionPanel">
                                                    <div class="accordion-item">
                                                            <button class="accordion-button bg-white text-dark border-bottom pl-0" type="button" id="accordionButton" data-bs-toggle="collapse" data-bs-target="#accordionCollapsePanel" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                                                <p class="fw-bold mt-3">Subjects Preview</p>
                                                            </button>
                                                        <div id="accordionCollapsePanel" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                                                            <div class="accordion-body p-1">
                                                                <span class="badge badge-secondary"><small class="fw-bold">S.Y. 2024 - 2025</small></span>
                                                                <div class="row mt-1">
                                                                    <div class="col">
                                                                        <table class="table table-hover table-bordered table-sm w-100" id="table">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th scope="col" class="text-center" id="admission-subjects-text"><small class="fw-bold">Grade Level</small></th> 
                                                                                    <th scope="col" class="text-center" id="admission-subjects-text"><small class="fw-bold">Subject Name</small></th>
                                                                                    <th scope="col" class="text-center" id="admission-subjects-text"><small class="fw-bold">Pre Requisite</small></th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody >
                                                                                
                                                                                <?php
                                                                                $fetchSubjectsQuery = "SELECT sj1.subjectname as subjectname, sj2.subjectname as prsubjectname, ss.gradelevel 
                                                                                FROM strandsubjects ss 
                                                                                LEFT JOIN subjects sj1 ON ss.subjectID = sj1.subjectID
                                                                                LEFT JOIN subjects sj2 ON sj1.pr_subjectID = sj2.subjectID
                                                                                WHERE ss.strandID = '$strandID' AND ss.gradelevel = '$gradelevel' ORDER BY sj1.subjectname";
                                                                                $fetchedSubjectData = mysqli_query($conn, $fetchSubjectsQuery);
                                                                                
                                                                                while($DataArray = mysqli_fetch_assoc($fetchedSubjectData)){
                                                                                    $subjectname = $DataArray['subjectname'];
                                                                                    $prsubjectname = ($DataArray['prsubjectname'] != null) ? $DataArray['prsubjectname']: "None";
                                                                                    $gradelevel1 = "Grade ".$DataArray['gradelevel'];
                                                                                    
                                                                                    ?>
                                                                                    <tr>
                                                                                        <td class="text-center" id="admission-subjects-text"><?php echo $gradelevel1; ?></td>
                                                                                        <td class="text-center" id="admission-subjects-text"><?php echo $subjectname; ?></td>
                                                                                        <td class="text-center" id="admission-subjects-text"><?php echo $prsubjectname; ?></td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </tbody>
                                                                        </table> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        
                                        <p class="border-bottom fw-bold mt-3">Enrollment Costs</p>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="container">
                                                    <div class="row mx-1 ">
                                                        <div class="col">
                                                            <small class="fw-bold">Miscellaneous Fees</small>
                                                            <!-- The contents are configured in the PHP code in the upper parts of this file -->
                                                            <?php echo $miscfeetext; ?>
                                                        </div>
                                                    </div> 
                                                </div> 
                                            </div>
                                            <div class="col-4">
                                                <div class="container">
                                                    <div class="row mx-1">
                                                        <div class="col">
                                                            <small class="fw-bold">Tuition Fee</small>
                                                            <p>₱<span id="tuitionfeetext"><?php echo $tuitionfee; ?>.00</span></p>
                                                        </div>
                                                    </div> 
                                                </div>  
                                            </div>

                                            <div class="col-4">
                                            <div class="container">
                                                    <div class="row mx-1">
                                                        <div class="col">
                                                            <small class="fw-bold">Total Enrollment Cost</small>
                                                            <p class="fw-bold fs-3">₱<span id="totalamounttext"><?php echo $totalamount; ?>.00</span></p>
                                                        </div>
                                                    </div> 
                                                </div> 
                                            </div>

                                            <!-- Payment Information container -->
                                            <p class="border-bottom fw-bold mt-3">Payment Information</p>
                                            <div class="container mb-1">

                                                <!-- will be hide/displayed based on detection of transaction ID-->
                                                <small id="nopaymentnotif" <?php echo $nopaymentnotif;?>>There's no payment record yet.</small>

                                                <!-- Payment Information container -- will be hide/displayed based on detection of transaction ID-->
                                                <div class="container-fluid" id="paymentdetailscontainer" <?php echo $paymentrecordcontainer;?>>
                                                    <!-- Transaction ID Display -->
                                                    <div class="row w-100 mt-1">
                                                        <div class="col-3">
                                                            <small id="small" class="fw-bold">Transaction ID</small>
                                                        </div>
                                                        <div class="col-1">
                                                            <small id="small" class="fw-bold">:</small>
                                                        </div>
                                                        <div class="col-8">
                                                            <small><?php echo $transactionID; ?></small>
                                                        </div>
                                                    </div>  
                                                    <!-- Payment Mode Display -->
                                                    <div class="row w-100" style="margin-top: -5px;">
                                                        <div class="col-3">
                                                            <small id="small" class="fw-bold">Payment Mode</small>
                                                        </div>
                                                        <div class="col-1">
                                                            <small id="small" class="fw-bold">:</small>
                                                        </div>
                                                        <div class="col-8">
                                                            <small><?php echo $paymentmode; ?></small>
                                                        </div>
                                                    </div>     
                                                    <!-- Amount Paid Display -->
                                                    <div class="row w-100" style="margin-top: -5px;">
                                                        <div class="col-3">
                                                            <small id="small" class="fw-bold">Amount Paid</small>
                                                        </div>
                                                        <div class="col-1">
                                                            <small id="small" class="fw-bold">:</small>
                                                        </div>
                                                        <div class="col-8">
                                                            <small>₱<?php echo $amount; ?></small>
                                                        </div>
                                                    </div>    
                                                    <!-- Payment Remarks Display -->
                                                    <div class="row w-100" style="margin-top: -5px;">
                                                        <div class="col-3">
                                                            <small id="small" class="fw-bold">Payment Remarks</small>
                                                        </div>
                                                        <div class="col-1">
                                                            <small id="small" class="fw-bold">:</small>
                                                        </div>
                                                        <div class="col-8">
                                                            <small><?php echo $paymentremarks; ?></small>
                                                        </div>
                                                    </div>    
                                                    <div class="row w-100">
                                                        <div class="col-5">
                                                            <?php echo $showproofbutton; ?>
                                                        </div>      
                                                    </div>    
                                                </div>
                                                            
                                            </div>
                                            <div class="row w-100 mt-3 ml-1 mb-3">
                                                <div class="col">
                                                    <a href="balancesettlement.php?enrollmentID=<?php echo $enrollmentID; ?>" id="paymentlink"><button class="btn btn-success w-100 ml-auto mr-auto"  id="page-btn" name="UpdateChecklist" data-bs-enrollmentID="<?php echo $enrollmentID;?>" 
                                                    <?php echo $proceedtopayment; ?>>Proceed to Payment</button></a>
                                                </div>
                                                <div class="col">
                                                    <form action="../processes/Student_ResubmitEnrollment.php" method="POST">
                                                        <input type="hidden" value="<?php echo $enrollmentID; ?>" name="enrollmentID">
                                                        <button class="btn btn-success w-100 ml-auto mr-auto" id="page-btn" type="submit" name="Resubmit" <?php echo $resubmit; ?>>Resubmit Enrollment</button>
                                                    </form> 
                                                </div>
                                            </div>
                                        </div> 
                                    </div>

                                    <div class="col-4">
                                        <form action="../processes/Student_UpdateChecklist.php" method="POST" enctype="multipart/form-data">
                                            <h5>Checklist</h5>
                                            <div class="container border shadow">
                                                <?php 
                                                $ctr = 0;
                                                if ($enrollmentcount != 0) {
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
                                                                    echo '<div class="row mx-1 mt-2">
                                                                            <div class="col">
                                                                                <small>'.$attachmentlabel.'</small>
                                                                                <div class="input-group mb-3">
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
                                                            echo '<div class="row mx-1 mt-2">
                                                                    <div class="col">
                                                                        <small>'.$attachmentlabel.'</small>
                                                                        <div class="input-group mb-3">
                                                                            <input type="file" class="form-control" name="'.$attachmentitem.'">
                                                                        </div>
                                                                    </div>
                                                                </div>   ';
                                                        }
                                                        $ctr++;
                                                    }
                                                }
                                                ?>
                                                <div class="row mt-3 ml-2 mr-2 mb-3" >
                                                    <input type="hidden" class="form-control" name="enrollmentID" value="<?php echo $enrollmentID; ?>">
                                                    <button class="btn btn-success w-100 ml-auto mr-auto" id="page-btn" type="submit" name="UpdateChecklist">Update Checklist</button>
                                                </div>
                                            </div> 
                                        </form>
                                    </div>
                                </div> 
                        </div>
                </div>
            </div>
<!-- Modals -->
<div class="modal fade" id="modal-View" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-4" style="font-family: Arial;">
                        <h5>View Payment Proof</h5>
                        
                            <div class="row mb-1">
                                <div class="col">
                                    <div class="container d-flex justify-content-center">
                                        <img class="img-thumbnail border shadow" id="paymentproofimage">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3 ml-2 mr-2 mb-3">
                                <div class="col">
                                    <button type="button" id="page-btn" class="btn btn-danger w-100" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                         
                </div>
            </div>
        </div>
</div>

    </div>
    <!-- End of Main Content -->
    <script>
       
    var transactionID = document.getElementById("transactionID").value;
    if (transactionID != '') {
        document.getElementById('paymentlink').href = "";
    }

    var viewModal = document.getElementById('modal-View')
    viewModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        var imgurl = button.getAttribute('data-bs-proofimgurl');
        
        viewModal.querySelector('#paymentproofimage').src = imgurl;
    });
    </script>
    <!-- Bootstrap JavaScript and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <?php
    require '../shared/footer.php';
    ?>