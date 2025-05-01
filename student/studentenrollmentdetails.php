<?php
require '../shared/header_student.php';
require '../shared/action-message.php';
 
$enrollmentID = $_GET['enrollmentID'];


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
$currentbalance = 0;
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

//computing for the current remaining balance
$currentbalance = $totalamount;
$CurrentPaidAmountQuery = mysqli_query($conn, "SELECT totalpaymentamount FROM paymentrecord WHERE enrollmentID = '$enrollmentID'");
while($Data = mysqli_fetch_assoc($CurrentPaidAmountQuery)){
    $currentbalance = $currentbalance - $Data['totalpaymentamount'];

    if ($currentbalance < 0) {
        $currentbalance = 0;
        break;
    }
}


$transactionID = '';
$paymentmode = '';
$amount = '';
$paymentremarks = '';
$showproofbutton = '';
$nopaymentnotif = 'style="display: none;"';
$paymentrecordcontainer = 'style="display: none;"';
$GetPaymentRecordsQuery = "SELECT
pr.transactionID,
pr.enrollmentID,
pm.description AS paymentmode1,
pr.amount,
pr.paymentremarks,
pr.proofimgurl,
pm.paymenttype AS paymenttype1,
pm.accountnumber AS accountnumber1,
pm2.description AS paymentmode2,
pr.secondamount,
pr.secondpaymentremarks,
pr.secondproofimgurl,
pm2.paymenttype AS paymenttype2,
pm2.accountnumber AS accountnumber2,
pr.totalpaymentamount,
pr.paymentdate
FROM paymentrecord pr
LEFT JOIN paymentmodes pm ON pr.paymentModeID = pm.paymentModeID
LEFT JOIN paymentmodes pm2 ON pr.secondPaymentModeID = pm2.paymentModeID
WHERE pr.enrollmentID='$enrollmentID'";
$GetPaymentRecord = mysqli_query($conn, $GetPaymentRecordsQuery);
if(mysqli_num_rows($GetPaymentRecord) > 0) {

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
                        
                    </div>
                    <!-- Content Row -->

                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                            
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-success">Enrollment Details</h6>
                                </div>
                                <div class="row mt-1 ml-1">
                                    <div class="col">
                                        <a href="enrollmentrecords.php"><button class="btn btn-secondary" style="font-size: 12px;"><i class="bi bi-arrow-left-short" id="table-btn-icon"></i> Go Back </button></a>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                <div class="row w-100">
                                    <div class="col-12">
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
                                                <small class="text-success"><?php echo $studentnumber; ?></small>
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
                                            <!-- <div class="row w-100" style="margin-top: -5px;">
                                                <div class="col-3">
                                                    <small id="small" class="fw-bold">Interest</small>
                                                </div>
                                                <div class="col-1">
                                                    <small id="small" class="fw-bold">:</small>
                                                </div>
                                                <div class="col-8">
                                                    <small><?php echo $interest; ?></small>
                                                </div>
                                            </div>  -->
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
                                                    <small class="text-success"><?php echo $enrollmentremarks; ?></small>
                                                </div>
                                            </div>                          
                                        </div>


                                        <!-- Enrollment Cost container -->
                                        <p class="border-bottom fw-bold mt-3" id="enrollmentcost-text">Enrollment Costs</p>
                                        <div class="row" id="enrollmentcost-container">
                                            <div class="col-3">
                                                <div class="container">
                                                    <div class="row mx-1 ">
                                                        <div class="col">
                                                            <small class="fw-bold" style="font-size: 12px;">Misc. Fees</small>
                                                            <!-- The contents are configured in the PHP code in the upper parts of this file -->
                                                            <?php echo $miscfeetext; ?>
                                                        </div>
                                                    </div> 
                                                </div> 
                                            </div>
                                            <div class="col-3">
                                                <div class="container">
                                                    <div class="row mx-1">
                                                        <div class="col">
                                                            <small class="fw-bold" style="font-size: 12px;">Tuition Fee</small>
                                                            <p>₱<span id="tuitionfeetext"><?php echo $tuitionfee; ?>.00</span></p>
                                                        </div>
                                                    </div> 
                                                </div>  
                                            </div>

                                            <div class="col-3">
                                                <div class="container">
                                                    <div class="row mx-1">
                                                        <div class="col">
                                                            <small class="fw-bold" style="font-size: 12px;">Total Enrollment Cost</small>
                                                            <p>₱<span id="totalamounttext"><?php echo $totalamount; ?></span></p>
                                                        </div>
                                                    </div> 
                                                </div> 
                                            </div>
                                            <div class="col-3">
                                                <div class="container">
                                                    <div class="row mx-1">
                                                        <div class="col">
                                                            <small class="fw-bold" style="font-size: 12px;">Current Balance</small>
                                                            <p class="fw-bold fs-3">₱<span id="currentbalancetext"><?php echo $currentbalance; ?></span></p>
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
                                            <div class="row mt-1">
                                                        <div class="col">
                                                            <table class="table table-hover table-bordered table-sm w-100">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col" class="text-center" id="admission-subjects-text"><small class="fw-bold">ID</small></th> 
                                                                        <th scope="col" class="text-center" id="admission-subjects-text"><small class="fw-bold">Primary MOP</small></th>
                                                                        <th scope="col" class="text-center" id="admission-subjects-text"><small class="fw-bold">Amount Paid</small></th>
                                                                        <th scope="col" class="text-center" id="admission-subjects-text"><small class="fw-bold">Remarks</small></th>
                                                                        <th scope="col" class="text-center" id="admission-subjects-text"><small class="fw-bold">Proof</small></th>
                                                                        <th scope="col" class="text-center" id="admission-subjects-text"><small class="fw-bold">Secondary MOP</small></th>
                                                                        <th scope="col" class="text-center" id="admission-subjects-text"><small class="fw-bold">Amount Paid</small></th>
                                                                        <th scope="col" class="text-center" id="admission-subjects-text"><small class="fw-bold">Remarks</small></th>
                                                                        <th scope="col" class="text-center" id="admission-subjects-text"><small class="fw-bold">Proof</small></th>
                                                                        <th scope="col" class="text-center" id="admission-subjects-text"><small class="fw-bold">Total Amount</small></th>
                                                                        <th scope="col" class="text-center" id="admission-subjects-text"><small class="fw-bold">Payment Date</small></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php
                                                                //Retrieve payment transactions
                                                                $GetPaymentRecords = mysqli_query($conn, $GetPaymentRecordsQuery);
                                                                while ($PaymentDetails = mysqli_fetch_assoc($GetPaymentRecords)) {
                                                                    $transactionID = $PaymentDetails['transactionID'];
                                                                    $accountnumber1 = $PaymentDetails['accountnumber1'];
                                                                    $paymenttype1 = $PaymentDetails['paymenttype1'];
                                                                    $proofimgurl1 = $PaymentDetails['proofimgurl'];
                                                                    $amount1 = $PaymentDetails['amount'];
                                                                    $paymentremarks1 = $PaymentDetails['paymentremarks'];
                                                                    $accountnumber2 = $PaymentDetails['accountnumber2'];
                                                                    $paymenttype2 = $PaymentDetails['paymenttype2'];
                                                                    $proofimgurl2 = $PaymentDetails['secondproofimgurl'];
                                                                    $amount2 = $PaymentDetails['secondamount'];
                                                                    $paymentremarks2 = $PaymentDetails['secondpaymentremarks'];
                                                                    $totalamount = $PaymentDetails['totalpaymentamount'];
                                                                    $paymentdate = $PaymentDetails['paymentdate'];
                                                                    $showproofbutton1 = '';
                                                                    $showproofbutton2 = '';
                                                                    $paymentmode1 = '';
                                                                    $paymentmode2 = '';
                                                                    if ($accountnumber1 != "" && $accountnumber1 != null) {
                                                                        $paymentmode1 = $PaymentDetails['paymentmode1'].' - '.$accountnumber1.' ('.$PaymentDetails['paymenttype1'].')';
                                                                    }
                                                                    else {
                                                                        $paymentmode1 = $PaymentDetails['paymentmode1'].' ('.$PaymentDetails['paymenttype1'].')';
                                                                    }


                                                                    if ($accountnumber2 != "" && $accountnumber2 != null) {
                                                                        $paymentmode2 = $PaymentDetails['paymentmode2'].' - '.$accountnumber2.' ('.$PaymentDetails['paymenttype2'].')';
                                                                    }
                                                                    else {
                                                                        $paymentmode2 = $PaymentDetails['paymentmode2'].' ('.$PaymentDetails['paymenttype2'].')';
                                                                    }


                                                                    if($paymenttype1 == "Online") {
                                                                        $showproofbutton1 = '<button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                                                                    data-bs-target="#modal-View"
                                                                                                    data-bs-proofimgurl="'.$proofimgurl1.'" style="font-size: 11px;"><i class="bi bi-eye-fill" id="table-btn-icon"></i> </button>';
                                                                    }
                                                                    else {
                                                                        $showproofbutton1 = 'N/A';
                                                                    }

                                                                    if($paymenttype2 == "Online") {
                                                                        $showproofbutton2 = '<button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                                                                    data-bs-target="#modal-View"
                                                                                                    data-bs-proofimgurl="'.$proofimgurl2.'" style="font-size: 11px;"><i class="bi bi-eye-fill" id="table-btn-icon"></i> </button>';
                                                                    }
                                                                    else {
                                                                        $showproofbutton2 = 'N/A';
                                                                    }
                                                                
                                                                    echo '
                                                                    <tr>
                                                                        <td class="text-center" id="admission-subjects-text">'.$transactionID.'</td>
                                                                        <td class="text-center" id="admission-subjects-text">'.$paymentmode1.'</td>
                                                                        <td class="text-center" id="admission-subjects-text">'.$amount1.'</td>
                                                                        <td class="text-center" id="admission-subjects-text">'.$paymentremarks1.'</td>
                                                                        <td class="text-center" id="admission-subjects-text">'.$showproofbutton1.'</td>
                                                                        <td class="text-center" id="admission-subjects-text">'.$paymentmode2.'</td>
                                                                        <td class="text-center" id="admission-subjects-text">'.$amount2.'</td>
                                                                        <td class="text-center" id="admission-subjects-text">'.$paymentremarks2.'</td>
                                                                        <td class="text-center" id="admission-subjects-text">'.$showproofbutton2.'</td>
                                                                        <td class="text-center" id="admission-subjects-text">'.$totalamount.'</td>
                                                                        <td class="text-center" id="admission-subjects-text">'.date('M d, Y', strtotime($paymentdate)).'</td>
                                                                    </tr>
                                                                    ';
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
