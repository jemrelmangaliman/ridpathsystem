<?php
require '../shared/header_registrar.php';
require '../shared/action-message.php';
 
$enrollmentID = $_GET['tempID'];
$pagetitle = $_GET['pagetitle'];
$returnpage = $_GET['returnpage'];

$fetchQuery = "SELECT * FROM enrollmentrecords ER 
LEFT JOIN  students ST ON ST.tempID = ER.studentID
LEFT JOIN enrollmentstatus ES ON ER.enrollmentStatusID = ES.statusID
LEFT JOIN strands SD ON SD.strandID = ER.strandID
LEFT JOIN tuitionfees TF ON TF.strandID = SD.strandID
LEFT JOIN studenttype SP ON ER.studentTypeID = SP.studentTypeID
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
$gradelevel = $DataArray['gradelevel'];
$gender = $DataArray['gender'];
$birthday = date('M d, Y', strtotime($DataArray['birthday']));
$address = ($DataArray['address'] != null ) ? $DataArray['address']  : 'Not yet defined';
$studenttype = $DataArray['studenttypedescription'];
$enrollmentremarks = $DataArray['enrollmentremarks'];
$studentnumber = ($DataArray['studentnumber'] != null) ? $DataArray['studentnumber'] : 0;
$studentID = $DataArray['tempID'];

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
    $miscfeetext .= '<br><small style="font-size: 12px;">₱'.$amount.' - '.$description.'</small>';   
   }
}
else {
    $miscfeetext = '<small style="font-size: 12px;">₱0.00</small>';
}

//getting the uploaded file attachments
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


//button containers and other containers-- displays appropriate buttons based on enrollment status
$assessmentbuttons = 'style="display: none;"';
$balancesettlementbuttons = 'style="display: none;"';
$admissionbutton = 'style="display: none;"';
$admissiondetailscontainer = 'style="display: none;"';
$hideremarksfield = 'style="display: flex;"';

switch ($enrollmentstatusID) {
    case "2":
        $assessmentbuttons = 'style="display: flex;"';
        break;
    case "4":
        $balancesettlementbuttons = 'style="display: flex;"';
        break;
    case "5":
        $admissionbutton = 'style="display: flex;"';
        $admissiondetailscontainer = 'style="display: block;"';
        break;
    case "6":
        $hideremarksfield = 'style="display: none;"';
        break;
    case "7":
        $hideremarksfield = 'style="display: none;"';
        break;

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
?>



                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Student Enrollment Details</h1>
                        
                    </div>
                    <!-- Content Row -->

                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                            
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $pagetitle; ?></h6>
                                </div>
                                <div class="row mt-1 ml-1">
                                    <div class="col">
                                        <a href="<?php echo $returnpage;?>.php"><button class="btn btn-secondary" style="font-size: 12px;"><i class="bi bi-arrow-left-short" id="table-btn-icon"></i> Go Back </button></a>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                <div class="row w-100">
                                    <div class="col-8">
                                        <!-- Personal Information container -->
                                        <p class="border-bottom fw-bold">Student Information</p>
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
                                            <!-- Home Address Display -->
                                            <div class="row w-100" style="margin-top: -5px;">
                                                <div class="col-3">
                                                    <small id="small" class="fw-bold">Student Number</small>
                                                </div>
                                                <div class="col-1">
                                                    <small id="small" class="fw-bold">:</small>
                                                </div>
                                                <div class="col-8">
                                                <small class="text-primary"><?php echo $studentnumber; ?></small>
                                                </div>
                                            </div> 
                                        </div>

                                        <!-- Enrollment Information container -->
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


                                        <!-- Enrollment Cost container -->
                                        <p class="border-bottom fw-bold mt-3" id="enrollmentcost-text">Enrollment Costs</p>
                                        <div class="row" id="enrollmentcost-container">
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
                                                            <p class="fw-bold fs-3">₱<span id="totalamounttext"><?php echo $totalamount; ?></span></p>
                                                        </div>
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

                                        <!-- Action Buttons-->
                                        <div class="row w-100 mt-3 ml-1 mb-3"> 
                                            <form action="../processes/Registrar_ChangeEnrollmentStatus.php" method="POST">
                                                <input type="hidden" value="<?php echo $enrollmentID; ?>" name="enrollmentID">
                                                <input type="hidden" value="<?php echo $studentID; ?>" name="studentID">
                                                <input type="hidden" value="<?php echo $returnpage; ?>" name="returnpage">
                                                
                                                <div class="row w-100 mt-3 mb-1" <?php echo $hideremarksfield; ?>>
                                                    <small>Enrollment Remarks</small>
                                                    <div class="col">
                                                            <textarea name="enrollmentremarks" class="form-control w-100" placeholder="Please include an enrollment remark" required></textarea>        
                                                    </div>  
                                                </div>
                                                <div class="container-fluid" <?php echo $admissiondetailscontainer;?>>
                                                    <div class="row w-100 mb-1">
                                                        <small>Student Number</small>
                                                        <div class="col">
                                                            <?php 
                                                                if ($studentnumber == 0 && $enrollmentstatusID == 5) {
                                                                    echo '<input type="number" class="form-control" name="studentnumber" required>';
                                                                }
                                                                else if ($studentnumber != 0 && $enrollmentstatusID == 5)  {
                                                                    echo '<input type="number" class="form-control" name="studentnumber" value="'.$studentnumber.'" readonly required>';
                                                                }
                                                            ?>
                                                                    
                                                        </div>  
                                                    </div>
                                                    <div class="row w-100 mb-1">
                                                        <small>Assign to Section</small>
                                                        <div class="col">
                                                                <select name="section" id="section" class="form-select" required>
                                                                    <?php
                                                                        //get sections aligned with the enrollee's chosen strand and grade level and have available slots
                                                                        $getSections = mysqli_query($conn, "SELECT * FROM sections ss
                                                                        LEFT JOIN strands st ON ss.strandID = st.strandID
                                                                        WHERE ss.strandID = '$strandID' AND ss.gradelevel = '$gradelevel' AND ss.currentavailableslot > 0");

                                                                        while ($sectionDetails = mysqli_fetch_assoc($getSections)) {
                                                                            $sectionname = $sectionDetails['abbreviation'].' '.$sectionDetails['gradelevel'].' - '.$sectionDetails['sectionname'].' ('.$sectionDetails['currentavailableslot'].' slot/s available)';

                                                                            echo '<option value="'.$sectionDetails['sectionID'].'">'.$sectionname.'</option>';
                                                                        }
                                                                    ?>
                                                                </select>        
                                                        </div>  
                                                    </div>
                                                </div>
                                                
                                                <div class="row w-100 mt-3 mb-3" <?php echo $assessmentbuttons; ?>>
                                                    <div class="col">
                                                            <button class="btn btn-success w-100 ml-auto mr-auto" id="page-btn" type="submit" name="ApproveEnrollment">Approve Enrollment</button>
                                                    </div>
                                                    <div class="col">
                                                            <button class="btn btn-danger w-100 ml-auto mr-auto" id="page-btn" type="submit" name="ReturnEnrollment">Return for Resubmission</button>
                                                    </div>
                                                </div>
                                                <div class="row w-100 mt-3 mb-3" <?php echo $balancesettlementbuttons; ?>>
                                                    <div class="col">   
                                                            <button class="btn btn-success w-100" id="page-btn" type="submit" name="ConfirmBalanceSettlement">Confirm Balance Settlement</button>
                                                    </div>
                                                    <!-- <div class="col">   
                                                            <button class="btn btn-danger w-100" id="page-btn" type="submit" name="HoldEnrollment">Put On Hold</button>
                                                    </div> -->
                                                </div>
                                                <div class="row w-100 mt-3 mb-3" <?php echo $admissionbutton; ?>>
                                                    <div class="col">   
                                                            <button class="btn btn-success w-100" id="page-btn" type="submit" name="ConfirmAdmission">Confirm Admission</button>
                                                    </div> 
                                                </div>
                                                
                                            </form>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                            <h5>Download Attachments</h5>
                                            <div class="container border shadow pt-3">
                                            <?php 
                                                $ctr = 0;
                                                
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
                                                                    echo '<div class="row mx-1">
                                                                            <div class="col">
                                                                                <small>'.$attachmentlabel.'</small>
                                                                                <div class="input-group mb-3" style="font-size: 14px;">
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
                                                            echo '<div class="row mx-1">
                                                                    <div class="col">
                                                                        <small>'.$attachmentlabel.'</small>
                                                                        <div class="input-group mb-2" style="font-size: 14px;">
                                                                            <i class="bi bi-x-circle-fill text-danger mr-2"></i><p>Not yet submitted</p>
                                                                        </div>
                                                                    </div>
                                                                </div>';
                                                        }
                                                        $ctr++;
                                                    }
                                                
                                                ?>
                                                
                                            </div> 
                                    </div>
                                </div> 
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
                <!-- /.container-fluid -->

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
    document.addEventListener("DOMContentLoaded", function() {
        $('#table').DataTable();
    });
    var viewModal = document.getElementById('modal-View')
    viewModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        var imgurl = button.getAttribute('data-bs-proofimgurl');
        
        viewModal.querySelector('#paymentproofimage').src = imgurl;
    });
</script>

<?php
    require '../shared/footer.php';
?>
